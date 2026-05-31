<?php

namespace App\Livewire\Admin\Pages\Sizes;

use App\Models\Size;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Novo Tamanho')]
class Create extends Component
{
    public string $label = '';

    public int $order = 0;

    public bool $active = true;

    public function mount(): void
    {
        $this->order = (Size::max('order') ?? -1) + 1;
    }

    public function save(): void
    {
        $this->validate([
            'label' => 'required|string|max:20',
            'order' => 'required|integer|min:0',
        ]);

        Size::create([
            'label' => $this->label,
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Tamanho criado com sucesso.');
        $this->redirect(route('admin.sizes.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.sizes.create');
    }
}
