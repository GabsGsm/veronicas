<?php

namespace App\Livewire\Admin\Pages\HomeLayout;

use App\Models\HomeContainer;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Novo Container')]
class CreateContainer extends Component
{
    public string $name = '';

    public string $type = 'full_width';

    public bool $active = true;

    public int $order = 0;

    public function mount(): void
    {
        $this->order = (HomeContainer::max('order') ?? -1) + 1;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:full_width',
            'order' => 'required|integer|min:0',
        ]);

        HomeContainer::create([
            'name' => $this->name,
            'type' => $this->type,
            'active' => $this->active,
            'order' => $this->order,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Container criado com sucesso.');
        $this->redirect(route('admin.home-layout.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.home-layout.create-container');
    }
}
