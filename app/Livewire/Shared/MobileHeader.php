<?php

namespace App\Livewire\Shared;

use App\Models\MenuItem;
use Livewire\Component;

class MobileHeader extends Component
{
    public bool $menuOpen = false;

    public function render()
    {
        $menuItems = MenuItem::where('active', true)->orderBy('order')->get();

        return view('livewire.shared.mobile-header', compact('menuItems'));
    }
}
