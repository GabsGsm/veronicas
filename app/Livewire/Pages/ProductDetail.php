<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\ManagesFavorites;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ProductDetail extends Component
{
    use ManagesFavorites;

    public Product $product;

    public function mount(string $slug): void
    {
        $this->product = Product::with(['category', 'collection'])
            ->where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();
    }

    /** @return Collection<int, Product> */
    protected function relatedProducts(): Collection
    {
        return Product::with('category')
            ->where('id', '!=', $this->product->id)
            ->where(function ($q): void {
                $q->where('category_id', $this->product->category_id)
                    ->orWhere('collection_id', $this->product->collection_id);
            })
            ->where('active', true)
            ->limit(4)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.pages.product-detail', [
            'related' => $this->relatedProducts(),
            'collection' => $this->product->collection,
        ])->title($this->product->name." | Verônica's Fashion");
    }
}
