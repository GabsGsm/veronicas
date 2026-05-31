<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\ManagesFavorites;
use App\Models\HomeContainer;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title("Verônica's Fashion")]
class Home extends Component
{
    use ManagesFavorites;

    public function render(): View
    {
        $containers = HomeContainer::where('active', true)
            ->orderBy('order')
            ->with(['sections' => fn ($q) => $q->where('active', true)->orderBy('order')])
            ->get();

        $containers->each(
            fn ($container) => $container->sections->each(
                fn ($section) => $section->setRelation('data', $section->loadData())
            )
        );

        return view('livewire.pages.home', compact('containers'));
    }
}
