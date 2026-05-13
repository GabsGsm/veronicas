<?php

namespace App\Livewire\Admin\Pages\Products;

use App\Livewire\Admin\Concerns\HasAdminTable;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Produtos')]
class Index extends Component
{
    use HasAdminTable;

    public function delete(int $id): void
    {
        Product::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Produto removido com sucesso.');
    }

    public function render(): View
    {
        $products = Product::query()
            ->with('category')
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.pages.products.index', compact('products'));
    }
}
