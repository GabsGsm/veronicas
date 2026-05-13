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
#[Title('Novo Produto')]
class Create extends Component
{
    use WithFileUploads;

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

    public $primaryImage = null;
    public array $galleryImages = [];

    public function updatedName(): void
    {
        if ($this->slug === '') {
            $this->slug = Str::slug($this->name);
        }
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

    public function removeGalleryImage(int $index): void
    {
        array_splice($this->galleryImages, $index, 1);
    }

    public function save(): void
    {
        $this->validate([
            'name'              => 'required|string|max:255',
            'slug'              => 'required|string|max:255|unique:products,slug',
            'category_id'       => 'required|exists:categories,id',
            'price'             => 'required|numeric|min:0',
            'promotional_price' => 'nullable|numeric|min:0',
            'primaryImage'      => 'nullable|image|max:2048',
            'galleryImages.*'   => 'nullable|image|max:2048',
        ]);

        $primaryPath = $this->primaryImage
            ? $this->primaryImage->store('products', 'public')
            : null;

        $galleryPaths = array_map(
            fn ($img) => $img->store('products', 'public'),
            $this->galleryImages
        );

        Product::create([
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
            'gallery'                 => $galleryPaths ?: null,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Produto criado com sucesso.');
        $this->redirect(route('admin.products.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.products.create', [
            'categories'  => Category::orderBy('name')->get(),
            'collections' => Collection::orderBy('title')->get(),
        ]);
    }
}
