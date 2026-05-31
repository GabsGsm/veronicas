<?php

namespace App\Livewire\Admin\Pages\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Nova Categoria')]
class Create extends Component
{
    public string $name = '';

    public string $icon = '';

    public string $description = '';

    public int $order = 0;

    public bool $active = true;

    public function mount(): void
    {
        $this->order = (Category::max('order') ?? -1) + 1;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'icon' => $this->icon ?: null,
            'description' => $this->description ?: null,
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Categoria criada com sucesso.');
        $this->redirect(route('admin.categories.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.categories.create');
    }
}
