<?php

namespace App\Livewire\Shared;

use App\Models\MenuItem;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $menuItems = MenuItem::where('active', true)->orderBy('order')->get();

        return view('livewire.shared.sidebar', compact('menuItems'));
    }
}
