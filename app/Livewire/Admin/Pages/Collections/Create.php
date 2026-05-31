<?php

namespace App\Livewire\Admin\Pages\Collections;

use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Nova Coleção')]
class Create extends Component
{
    use WithFileUploads;

    public string $title = '';

    public string $slug = '';

    public string $subtitle = '';

    public string $description = '';

    public string $story = '';

    public bool $active = true;

    public bool $featured = false;

    public int $order = 0;

    public $coverImage = null;

    public $bannerImage = null;

    public function mount(): void
    {
        $this->order = (Collection::max('order') ?? -1) + 1;
    }

    public function updatedTitle(): void
    {
        $this->slug = Str::slug($this->title);
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'coverImage' => 'nullable|image|max:2048',
            'bannerImage' => 'nullable|image|max:2048',
        ]);

        $this->slug = $this->uniqueSlug($this->title);

        $coverPath = $this->coverImage ? $this->coverImage->store('collections', 'public') : null;
        $bannerPath = $this->bannerImage ? $this->bannerImage->store('collections', 'public') : null;

        Collection::create([
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

        $this->dispatch('toast', type: 'success', message: 'Coleção criada com sucesso.');
        $this->redirect(route('admin.collections.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.collections.create');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 2;

        while (
            Collection::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
