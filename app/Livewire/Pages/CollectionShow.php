<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\ManagesFavorites;
use App\Models\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class CollectionShow extends Component
{
    use ManagesFavorites;

    public Collection $collection;

    public function mount(string $slug): void
    {
        $this->collection = Collection::with(['products' => fn ($q) => $q->where('active', true)->with('category')])
            ->where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();
    }

    public function render(): View
    {
        return view('livewire.pages.collection-show')
            ->title($this->collection->title." | Verônica's Fashion");
    }
}
