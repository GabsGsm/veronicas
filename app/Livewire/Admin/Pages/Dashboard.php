<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Banner;
use App\Models\Collection;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Painel')]
class Dashboard extends Component
{
    public function render(): View
    {
        return view('livewire.admin.pages.dashboard', [
            'stats' => [
                'products'       => Product::count(),
                'productsActive' => Product::where('active', true)->count(),
                'productsSale'   => Product::whereNotNull('promotional_price_cents')->count(),
                'banners'        => Banner::count(),
                'bannersActive'  => Banner::where('active', true)->count(),
                'collections'    => Collection::count(),
                'users'          => User::count(),
            ],
            'latestProducts' => Product::with('category')->latest()->limit(5)->get(),
        ]);
    }
}
