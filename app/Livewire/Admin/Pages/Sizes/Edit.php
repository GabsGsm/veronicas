<?php

namespace App\Livewire\Admin\Pages\Sizes;

use App\Models\Size;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Editar Tamanho')]
class Edit extends Component
{
    public int $sizeId;

    public string $label = '';

    public int $order = 0;

    public bool $active = true;

    public function mount(int $id): void
    {
        $size = Size::findOrFail($id);
        $this->sizeId = $size->id;
        $this->label = $size->label;
        $this->order = $size->order;
        $this->active = $size->active;
    }

    public function save(): void
    {
        $this->validate([
            'label' => 'required|string|max:20',
            'order' => 'required|integer|min:0',
        ]);

        Size::findOrFail($this->sizeId)->update([
            'label' => $this->label,
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Tamanho atualizado com sucesso.');
        $this->redirect(route('admin.sizes.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.sizes.edit');
    }
}
