<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\ManagesFavorites;
use App\Models\Category;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Catálogo unificado — suporta os modos:
 *  - featured  → where('featured', true)
 *  - new       → tag='Nova Coleção' (legado; mantido por compatibilidade)
 *  - sale      → promotional_price_cents != null
 *  - category  → category slug
 *  - occasion  → occasion slug → resolves to name
 *  - tag       → tag slug → resolves to name
 *  - search    → filtros via query string: categorias[], tags[], ocasioes[], colecoes[], featured, promocional
 */
#[Layout('components.layouts.app')]
class Catalog extends Component
{
    use ManagesFavorites, WithPagination;

    public string $mode = 'featured';

    public ?string $category = null;

    public ?string $occasion = null;

    public ?string $tag = null;

    /** @var array<string, mixed> */
    public array $activeFilters = [];

    /**
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
            $this->mode === 'category' && $this->category !== null => (function () {
                $cat = Category::where('slug', $this->category)->first();

                return [
                    'decorative' => 'Categoria',
                    'title' => $cat?->name ?? ucfirst(str_replace('-', ' ', $this->category)),
                    'subtitle' => $cat?->description ?? 'Explore nossa seleção',
                ];
            })(),
            $this->mode === 'occasion' && $this->occasion !== null => (function () {
                $occ = Occasion::where('slug', $this->occasion)->first();

                return [
                    'decorative' => 'Ocasião',
                    'title' => $occ?->name ?? ucfirst($this->occasion),
                    'subtitle' => 'Peças selecionadas para cada momento',
                ];
            })(),
            $this->mode === 'tag' && $this->tag !== null => (function () {
                $tagModel = Tag::where('slug', $this->tag)->first();

                return [
                    'decorative' => 'Coleção',
                    'title' => $tagModel?->name ?? ucfirst(str_replace('-', ' ', $this->tag)),
                    'subtitle' => 'Produtos selecionados',
                ];
            })(),
            $this->mode === 'search' => [
                'decorative' => 'Busca',
                'title' => 'Resultados',
                'subtitle' => 'Produtos encontrados para sua seleção',
            ],
            default => [
                'decorative' => 'Catálogo',
                'title' => 'Catálogo',
                'subtitle' => 'Explore nossa seleção',
            ],
        };
    }

    public function mount(
        string $mode,
        ?string $category = null,
        ?string $occasion = null,
        ?string $tag = null
    ): void {
        $this->mode = $mode;
        $this->category = $category;
        $this->occasion = $occasion;
        $this->tag = $tag;
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

        match ($this->mode) {
            'featured' => $query->where('featured', true),
            'new' => $query->where('tag', 'Nova Coleção'),
            'sale' => $query->whereNotNull('promotional_price_cents'),
            'category' => $query->whereHas('category', fn ($q) => $q->where('slug', $this->category)),
            'occasion' => (function () use ($query): void {
                $occ = Occasion::where('slug', $this->occasion)->first();
                if ($occ) {
                    $query->where('occasion', $occ->name);
                }
            })(),
            'tag' => (function () use ($query): void {
                $tagModel = Tag::where('slug', $this->tag)->first();
                if ($tagModel) {
                    $query->where('tag', $tagModel->name);
                }
            })(),
            'search' => (function () use ($query): void {
                $categorias = request()->query('categorias', []);
                $tags = request()->query('tags', []);
                $ocasioes = request()->query('ocasioes', []);
                $colecoes = request()->query('colecoes', []);

                if (! empty($categorias)) {
                    $query->whereHas('category', fn ($q) => $q->whereIn('slug', (array) $categorias));
                }

                if (! empty($tags)) {
                    $tagNames = Tag::whereIn('slug', (array) $tags)->pluck('name')->toArray();
                    if (! empty($tagNames)) {
                        $query->whereIn('tag', $tagNames);
                    }
                }

                if (! empty($ocasioes)) {
                    $occNames = Occasion::whereIn('slug', (array) $ocasioes)->pluck('name')->toArray();
                    if (! empty($occNames)) {
                        $query->whereIn('occasion', $occNames);
                    }
                }

                if (! empty($colecoes)) {
                    $query->whereHas('collection', fn ($q) => $q->whereIn('slug', (array) $colecoes));
                }

                if (request()->boolean('featured')) {
                    $query->where('featured', true);
                }

                if (request()->boolean('promocional')) {
                    $query->whereNotNull('promotional_price_cents');
                }
            })(),
            default => null,
        };

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

        if ($this->mode === 'search') {
            match (request()->query('ordem', 'newest')) {
                'oldest' => $query->oldest('id'),
                'price_asc' => $query->orderBy('price_cents'),
                'price_desc' => $query->orderBy('price_cents', 'desc'),
                'featured' => $query->orderBy('featured', 'desc')->orderBy('order'),
                default => $query->latest('id'),
            };
        } else {
            $query->orderBy('order');
        }

        return $query->paginate(12);
    }

    public function render(): View
    {
        return view('livewire.pages.catalog', [
            'products' => $this->loadProducts(),
            'config' => $this->pageConfig(),
        ]);
    }
}
