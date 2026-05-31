<?php

namespace App\Livewire\Admin\Pages\Collections;

use App\Models\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Editar Coleção')]
class Edit extends Component
{
    use WithFileUploads;

    public int $collectionId;

    public string $title = '';

    public string $slug = '';

    public string $subtitle = '';

    public string $description = '';

    public string $story = '';

    public bool $active = true;

    public bool $featured = false;

    public int $order = 0;

    public ?string $existingCoverImage = null;

    public ?string $existingBannerImage = null;

    public $newCoverImage = null;

    public $newBannerImage = null;

    public function mount(int $id): void
    {
        $collection = Collection::findOrFail($id);
        $this->collectionId = $collection->id;
        $this->title = $collection->title;
        $this->slug = $collection->slug;
        $this->subtitle = $collection->subtitle ?? '';
        $this->description = $collection->description ?? '';
        $this->story = $collection->story ?? '';
        $this->active = $collection->active;
        $this->featured = $collection->featured;
        $this->order = $collection->order;
        $this->existingCoverImage = $collection->cover_image;
        $this->existingBannerImage = $collection->banner_image;
    }

    public function removeExistingCoverImage(): void
    {
        $this->existingCoverImage = null;
    }

    public function removeExistingBannerImage(): void
    {
        $this->existingBannerImage = null;
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:collections,slug,{$this->collectionId}",
            'newCoverImage' => 'nullable|image|max:2048',
            'newBannerImage' => 'nullable|image|max:2048',
        ]);

        $collection = Collection::findOrFail($this->collectionId);

        $coverPath = $this->existingCoverImage;
        if ($this->newCoverImage) {
            $coverPath = $this->newCoverImage->store('collections', 'public');
        }

        $bannerPath = $this->existingBannerImage;
        if ($this->newBannerImage) {
            $bannerPath = $this->newBannerImage->store('collections', 'public');
        }

        $collection->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle ?: null,
            'description' => $this->description ?: null,
            'story' => $this->story ?: null,
            'active' => $this->active,
            'featured' => $this->featured,
            'order' => $this->order,
            'cover_image' => $coverPath,
            'banner_image' => $bannerPath,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Coleção atualizada com sucesso.');
        $this->redirect(route('admin.collections.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.collections.edit');
    }
}
