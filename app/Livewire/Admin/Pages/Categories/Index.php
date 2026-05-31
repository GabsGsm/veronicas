<?php

namespace App\Livewire\Admin\Pages\Categories;

use App\Livewire\Admin\Concerns\HasAdminTable;
use App\Models\Category;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Categorias')]
class Index extends Component
{
    use HasAdminTable;

    public function mount(): void
    {
        $this->sortBy = 'order';
        $this->sortDir = 'asc';
    }

    public function moveUp(int $id): void
    {
        $item = Category::findOrFail($id);
        $prev = Category::where('order', '<', $item->order)->orderByDesc('order')->first();
        if ($prev) {
            [$item->order, $prev->order] = [$prev->order, $item->order];
            $item->save();
            $prev->save();
        }
    }

    public function moveDown(int $id): void
    {
        $item = Category::findOrFail($id);
        $next = Category::where('order', '>', $item->order)->orderBy('order')->first();
        if ($next) {
            [$item->order, $next->order] = [$next->order, $item->order];
            $item->save();
            $next->save();
        }
    }

    public function updateOrder(int $id, int $newOrder): void
    {
        Category::findOrFail($id)->update(['order' => $newOrder]);
    }

    public function delete(int $id): void
    {
        Category::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Categoria removida com sucesso.');
    }

    public function render(): View
    {
        $categories = Category::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.pages.categories.index', compact('categories'));
    }
}
