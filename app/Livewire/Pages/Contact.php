<?php

namespace App\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title("Contato | Verônica's Fashion")]
class Contact extends Component
{
    public function render(): View
    {
        return view('livewire.pages.contact');
    }
}
