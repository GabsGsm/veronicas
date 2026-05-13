<?php

namespace App\Livewire\Shared;

use Livewire\Component;

class MobileHeader extends Component
{
    public bool $menuOpen = false;

    /** @var array<int, array{label: string, icon: string, route: string, params?: array<string, string>}> */
    public array $menuItems;

    public function mount(): void
    {
        // reaproveita a mesma lista da Sidebar
        $this->menuItems = (new Sidebar())->menuItems;
    }

    public function render()
    {
        return view('livewire.shared.mobile-header');
    }
}
