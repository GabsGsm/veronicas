<?php

namespace App\Livewire\Admin\Pages\Banners;

use App\Models\Banner;
use App\Models\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Editar Banner')]
class Edit extends Component
{
    use WithFileUploads;

    public int $bannerId;
    public string $title = '';
    public string $subtitle = '';
    public string $description = '';
    public string $cta_label = '';
    public ?int $collection_id = null;
    public bool $active = true;
    public int $order = 0;
    public ?string $existingImage = null;
    public $newImage = null;

    public function mount(int $id): void
    {
        $banner               = Banner::findOrFail($id);
        $this->bannerId       = $banner->id;
        $this->title          = $banner->title;
        $this->subtitle       = $banner->subtitle ?? '';
        $this->description    = $banner->description ?? '';
        $this->cta_label      = $banner->cta_label ?? '';
        $this->collection_id  = $banner->collection_id;
        $this->active         = $banner->active;
        $this->order          = $banner->order;
        $this->existingImage  = $banner->image;
    }

    public function removeExistingImage(): void
    {
        $this->existingImage = null;
    }

    public function save(): void
    {
        $this->validate([
            'title'         => 'required|string|max:255',
            'collection_id' => 'nullable|exists:collections,id',
            'newImage'      => 'nullable|image|max:2048',
        ]);

        $banner = Banner::findOrFail($this->bannerId);

        $imagePath = $this->existingImage;
        if ($this->newImage) {
            $imagePath = $this->newImage->store('banners', 'public');
        }

        $banner->update([
            'title'         => $this->title,
            'subtitle'      => $this->subtitle ?: null,
            'description'   => $this->description ?: null,
            'cta_label'     => $this->cta_label ?: null,
            'collection_id' => $this->collection_id ?: null,
            'active'        => $this->active,
            'order'         => $this->order,
            'image'         => $imagePath,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Banner atualizado com sucesso.');
        $this->redirect(route('admin.banners.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.banners.edit', [
            'collections' => Collection::orderBy('title')->get(),
        ]);
    }
}
