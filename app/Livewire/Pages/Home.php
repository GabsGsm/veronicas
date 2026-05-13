<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\ManagesFavorites;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title("Verônica's Fashion — Catálogo Premium")]
class Home extends Component
{
    use ManagesFavorites;

    public function render(): View
    {
        return view('livewire.pages.home', [
            'banners' => Banner::where('active', true)->orderBy('order')->get(),
            'featuredProducts' => Product::where('featured', true)->with('category')->orderBy('id', 'desc')->limit(4)->get(),
            'newCollection' => Product::where('tag', 'Nova Coleção')->with('category')->orderBy('id', 'desc')->limit(4)->get(),
            'promoProducts' => Product::whereNotNull('promotional_price_cents')->with('category')->orderBy('id', 'desc')->limit(4)->get(),
        ]);
    }
}
