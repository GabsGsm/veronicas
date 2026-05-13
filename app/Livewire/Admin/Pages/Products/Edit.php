<?php

namespace App\Livewire\Admin\Pages\Products;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Editar Produto')]
class Edit extends Component
{
    use WithFileUploads;

    public int $productId;

    public string $name = '';
    public string $slug = '';
    public ?int $category_id = null;
    public ?int $collection_id = null;
    public string $tag = '';
    public string $occasion = '';
    public bool $active = true;
    public bool $featured = false;
    public int $order = 0;

    public string $price = '';
    public string $promotional_price = '';

    public string $short_description = '';
    public string $description = '';

    public string $fabric = '';
    public string $fabric_details = '';
    public array $sizes = [];
    public array $colors = [];
    public array $care = [];
    public string $newCareItem = '';

    public ?string $existingPrimaryImage = null;
    public $newPrimaryImage = null;
    public array $existingGallery = [];
    public array $newGalleryImages = [];

    public function mount(int $id): void
    {
        $product = Product::findOrFail($id);
        $this->productId        = $product->id;
        $this->name             = $product->name;
        $this->slug             = $product->slug;
        $this->category_id      = $product->category_id;
        $this->collection_id    = $product->collection_id;
        $this->tag              = $product->tag ?? '';
        $this->occasion         = $product->occasion ?? '';
        $this->active           = $product->active;
        $this->featured         = $product->featured;
        $this->order            = $product->order;
        $this->price            = number_format($product->price_cents / 100, 2, '.', '');
        $this->promotional_price = $product->promotional_price_cents
            ? number_format($product->promotional_price_cents / 100, 2, '.', '')
            : '';
        $this->short_description    = $product->short_description ?? '';
        $this->description          = $product->description ?? '';
        $this->fabric               = $product->fabric ?? '';
        $this->fabric_details       = $product->fabric_details ?? '';
        $this->sizes                = $product->sizes ?? [];
        $this->colors               = $product->colors ?? [];
        $this->care                 = $product->care ?? [];
        $this->existingPrimaryImage = $product->primary_image;
        $this->existingGallery      = $product->gallery ?? [];
    }

    public function removeExistingPrimaryImage(): void
    {
        $this->existingPrimaryImage = null;
    }

    public function removeExistingGalleryImage(int $index): void
    {
        array_splice($this->existingGallery, $index, 1);
    }

    public function removeNewGalleryImage(int $index): void
    {
        array_splice($this->newGalleryImages, $index, 1);
    }

    public function addCareItem(): void
    {
        if (filled($this->newCareItem)) {
            $this->care[] = $this->newCareItem;
            $this->newCareItem = '';
        }
    }

    public function removeCareItem(int $index): void
    {
        array_splice($this->care, $index, 1);
    }

    public function save(): void
    {
        $this->validate([
            'name'               => 'required|string|max:255',
            'slug'               => "required|string|max:255|unique:products,slug,{$this->productId}",
            'category_id'        => 'required|exists:categories,id',
            'price'              => 'required|numeric|min:0',
            'promotional_price'  => 'nullable|numeric|min:0',
            'newPrimaryImage'    => 'nullable|image|max:2048',
            'newGalleryImages.*' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($this->productId);

        $primaryPath = $this->existingPrimaryImage;
        if ($this->newPrimaryImage) {
            $primaryPath = $this->newPrimaryImage->store('products', 'public');
        }

        $newPaths = array_map(
            fn ($img) => $img->store('products', 'public'),
            $this->newGalleryImages
        );

        $product->update([
            'name'                    => $this->name,
            'slug'                    => $this->slug,
            'category_id'             => $this->category_id,
            'collection_id'           => $this->collection_id ?: null,
            'tag'                     => $this->tag ?: null,
            'occasion'                => $this->occasion ?: null,
            'active'                  => $this->active,
            'featured'                => $this->featured,
            'order'                   => $this->order,
            'price_cents'             => (int) round((float) $this->price * 100),
            'promotional_price_cents' => filled($this->promotional_price) ? (int) round((float) $this->promotional_price * 100) : null,
            'short_description'       => $this->short_description ?: null,
            'description'             => $this->description ?: null,
            'fabric'                  => $this->fabric ?: null,
            'fabric_details'          => $this->fabric_details ?: null,
            'sizes'                   => $this->sizes ?: null,
            'colors'                  => $this->colors ?: null,
            'care'                    => $this->care ?: null,
            'primary_image'           => $primaryPath,
            'gallery'                 => array_merge($this->existingGallery, $newPaths) ?: null,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Produto atualizado com sucesso.');
        $this->redirect(route('admin.products.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.products.edit', [
            'categories'  => Category::orderBy('name')->get(),
            'collections' => Collection::orderBy('title')->get(),
        ]);
    }
}
