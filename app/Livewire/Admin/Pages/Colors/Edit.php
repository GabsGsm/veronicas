<?php

namespace App\Livewire\Admin\Pages\Colors;

use App\Models\Color;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Editar Cor')]
class Edit extends Component
{
    public int $colorId;

    public string $name = '';

    public string $hex_code = '#000000';

    public int $order = 0;

    public bool $active = true;

    public function mount(int $id): void
    {
        $color = Color::findOrFail($id);
        $this->colorId = $color->id;
        $this->name = $color->name;
        $this->hex_code = $color->hex_code;
        $this->order = $color->order;
        $this->active = $color->active;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'hex_code' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'order' => 'required|integer|min:0',
        ]);

        Color::findOrFail($this->colorId)->update([
            'name' => $this->name,
            'hex_code' => $this->hex_code,
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Cor atualizada com sucesso.');
        $this->redirect(route('admin.colors.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.colors.edit');
    }
}
