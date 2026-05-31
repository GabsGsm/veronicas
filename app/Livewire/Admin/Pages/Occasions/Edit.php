<?php

namespace App\Livewire\Admin\Pages\Occasions;

use App\Models\Occasion;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Editar Ocasião')]
class Edit extends Component
{
    public int $occasionId;

    public string $name = '';

    public int $order = 0;

    public bool $active = true;

    public function mount(int $id): void
    {
        $occasion = Occasion::findOrFail($id);
        $this->occasionId = $occasion->id;
        $this->name = $occasion->name;
        $this->order = $occasion->order;
        $this->active = $occasion->active;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        Occasion::findOrFail($this->occasionId)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Ocasião atualizada com sucesso.');
        $this->redirect(route('admin.occasions.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.occasions.edit');
    }
}
