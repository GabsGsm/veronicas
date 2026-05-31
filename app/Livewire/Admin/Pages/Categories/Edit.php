<?php

namespace App\Livewire\Admin\Pages\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Editar Categoria')]
class Edit extends Component
{
    public int $categoryId;

    public string $name = '';

    public string $icon = '';

    public string $description = '';

    public int $order = 0;

    public bool $active = true;

    public function mount(int $id): void
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->icon = $category->icon ?? '';
        $this->description = $category->description ?? '';
        $this->order = $category->order;
        $this->active = $category->active;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        Category::findOrFail($this->categoryId)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'icon' => $this->icon ?: null,
            'description' => $this->description ?: null,
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Categoria atualizada com sucesso.');
        $this->redirect(route('admin.categories.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.categories.edit');
    }
}
