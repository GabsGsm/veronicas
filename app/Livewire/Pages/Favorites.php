<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\ManagesFavorites;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title("Favoritos | Verônica's Fashion")]
class Favorites extends Component
{
    use ManagesFavorites;

    public function render(): View
    {
        $favoriteProducts = empty($this->favorites)
            ? collect()
            : Product::with('category')->whereIn('id', $this->favorites)->where('active', true)->get();

        return view('livewire.pages.favorites', [
            'favoriteProducts' => $favoriteProducts,
        ]);
    }
}
