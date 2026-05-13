<?php

namespace App\Livewire\Pages;

use App\Enums\Occasion;
use App\Livewire\Concerns\ManagesFavorites;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Catálogo unificado — substitui o CategoryPage do React e suporta as variantes:
 *  - destaques  → featured=true
 *  - nova       → tag='Nova Coleção'
 *  - categoria  → category slug
 *  - ocasião    → occasion = 'Festa' etc
 *  - promoções  → promotional_price_cents != null
 */
#[Layout('components.layouts.app')]
class Catalog extends Component
{
    use ManagesFavorites, WithPagination;

    public string $mode = 'featured';

    public ?string $category = null;

    public ?string $occasion = null;

    /** @var array<string, mixed> */
    public array $activeFilters = [];

    /**
     * Configuração visual da página (header + descrições).
     *
     * @return array{decorative: string, title: string, subtitle: string}
     */
    protected function pageConfig(): array
    {
        return match (true) {
            $this->mode === 'featured' => [
                'decorative' => 'Seleção especial',
                'title' => 'Destaques',
                'subtitle' => 'Nossas peças mais desejadas e exclusivas',
            ],
            $this->mode === 'new' => [
                'decorative' => 'Recém-chegadas',
                'title' => 'Nova Coleção',
                'subtitle' => 'As últimas tendências em moda feminina premium',
            ],
            $this->mode === 'sale' => [
                'decorative' => 'Ofertas especiais',
                'title' => 'Promoções',
                'subtitle' => 'Elegância premium com preços irresistíveis',
            ],
            $this->mode === 'occasion' && $this->occasion === Occasion::Festa->value => [
                'decorative' => 'Para momentos especiais',
                'title' => 'Festa',
                'subtitle' => 'Brilhe em cada celebração',
            ],
            $this->mode === 'category' && $this->category === 'vestidos' => [
                'decorative' => 'Elegância em cada detalhe',
                'title' => 'Vestidos',
                'subtitle' => 'Do casual ao festa, encontre o vestido perfeito',
            ],
            $this->mode === 'category' && $this->category === 'conjuntos' => [
                'decorative' => 'Look completo',
                'title' => 'Conjuntos',
                'subtitle' => 'Combinações sofisticadas prontas para usar',
            ],
            $this->mode === 'category' && $this->category === 'casual' => [
                'decorative' => 'Estilo do dia a dia',
                'title' => 'Casual',
                'subtitle' => 'Conforto e elegância para o cotidiano',
            ],
            $this->mode === 'category' && $this->category === 'acessorios' => [
                'decorative' => 'Toques finais',
                'title' => 'Acessórios',
                'subtitle' => 'Complete seu look com elegância',
            ],
            default => [
                'decorative' => 'Catálogo',
                'title' => 'Catálogo',
                'subtitle' => 'Explore nossa seleção',
            ],
        };
    }

    public function mount(string $mode, ?string $category = null, ?string $occasion = null): void
    {
        $this->mode = $mode;
        $this->category = $category;
        $this->occasion = $occasion;
    }

    /** @param  array<string, mixed>  $filters */
    #[On('filters-applied')]
    public function onFiltersApplied(array $filters): void
    {
        $this->activeFilters = $filters;
        $this->resetPage();
    }

    /** @return LengthAwarePaginator<Product> */
    protected function loadProducts(): LengthAwarePaginator
    {
        $query = Product::query()->with('category')->where('active', true);

        // ---- modo base ----
        match ($this->mode) {
            'featured' => $query->where('featured', true),
            'new' => $query->where('tag', 'Nova Coleção'),
            'sale' => $query->whereNotNull('promotional_price_cents'),
            'category' => $query->whereHas('category', fn ($q) => $q->where('slug', $this->category)),
            'occasion' => $query->where('occasion', $this->occasion),
            default => null,
        };

        // ---- filtros adicionais (FilterPanel) ----
        $filters = $this->activeFilters;

        if (! empty($filters['sizes'])) {
            $query->where(function ($q) use ($filters): void {
                foreach ($filters['sizes'] as $size) {
                    $q->orWhereJsonContains('sizes', $size);
                }
            });
        }

        if (! empty($filters['colors'])) {
            $query->where(function ($q) use ($filters): void {
                foreach ($filters['colors'] as $color) {
                    $q->orWhereJsonContains('colors', $color);
                }
            });
        }

        if (! empty($filters['occasions'])) {
            $query->whereIn('occasion', $filters['occasions']);
        }

        if (! empty($filters['priceRange'])) {
            // converte label "R$ 150 - R$ 300" em centavos
            if (preg_match_all('/(\d+)/', $filters['priceRange'], $matches)) {
                $nums = $matches[1];
                if (str_contains($filters['priceRange'], 'Até')) {
                    $query->where('price_cents', '<=', (int) $nums[0] * 100);
                } elseif (str_contains($filters['priceRange'], 'Acima')) {
                    $query->where('price_cents', '>=', (int) $nums[0] * 100);
                } elseif (count($nums) >= 2) {
                    $query->whereBetween('price_cents', [(int) $nums[0] * 100, (int) $nums[1] * 100]);
                }
            }
        }

        return $query->orderBy('order')->paginate(12);
    }

    public function render(): View
    {
        return view('livewire.pages.catalog', [
            'products' => $this->loadProducts(),
            'config' => $this->pageConfig(),
        ]);
    }
}
