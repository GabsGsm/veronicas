<?php

namespace App\Livewire\Admin\Pages\Colors;

use App\Models\Color;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Nova Cor')]
class Create extends Component
{
    public string $name = '';

    public string $hex_code = '#000000';

    public int $order = 0;

    public bool $active = true;

    public function mount(): void
    {
        $this->order = (Color::max('order') ?? -1) + 1;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'hex_code' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'order' => 'required|integer|min:0',
        ]);

        Color::create([
            'name' => $this->name,
            'hex_code' => $this->hex_code,
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Cor criada com sucesso.');
        $this->redirect(route('admin.colors.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.colors.create');
    }
}
