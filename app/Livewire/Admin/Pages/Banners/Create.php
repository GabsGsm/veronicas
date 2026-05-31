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
#[Title('Novo Banner')]
class Create extends Component
{
    use WithFileUploads;

    public string $title = '';

    public string $subtitle = '';

    public string $description = '';

    public string $cta_label = '';

    public ?int $collection_id = null;

    public bool $active = true;

    public bool $hide_overlay = false;

    public string $image_position = 'center';

    public int $order = 0;

    public $image = null;

    public function mount(): void
    {
        $this->order = (Banner::max('order') ?? -1) + 1;
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'collection_id' => 'nullable|exists:collections,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->image
            ? $this->image->store('banners', 'public')
            : null;

        Banner::create([
            'title' => $this->title,
            'subtitle' => $this->subtitle ?: null,
            'description' => $this->description ?: null,
            'cta_label' => $this->cta_label ?: null,
            'hide_overlay' => $this->hide_overlay,
            'image_position' => $this->image_position,
            'collection_id' => $this->collection_id ?: null,
            'active' => $this->active,
            'order' => $this->order,
            'image' => $imagePath,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Banner criado com sucesso.');
        $this->redirect(route('admin.banners.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.banners.create', [
            'collections' => Collection::orderBy('title')->get(),
        ]);
    }
}
