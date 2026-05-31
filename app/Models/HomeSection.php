<?php

namespace App\Models;

use App\Models\Collection as FashionCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class HomeSection extends Model
{
    protected $fillable = [
        'home_container_id',
        'title',
        'description',
        'component_type',
        'data_source',
        'filter_type',
        'filter_values',
        'order_by',
        'limit',
        'show_title',
        'show_view_all',
        'view_all_label',
        'view_all_url',
        'view_all_position',
        'order',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'filter_values' => 'array',
            'limit' => 'integer',
            'order' => 'integer',
            'show_title' => 'boolean',
            'show_view_all' => 'boolean',
            'active' => 'boolean',
        ];
    }

    /** @return BelongsTo<HomeContainer, $this> */
    public function container(): BelongsTo
    {
        return $this->belongsTo(HomeContainer::class, 'home_container_id');
    }

    /** Carrega os dados da seção de acordo com a fonte e filtros configurados. */
    public function loadData(): Collection
    {
        return match ($this->data_source) {
            'banners' => $this->loadBanners(),
            'collections' => $this->loadCollections(),
            default => $this->loadProducts(),
        };
    }

    private function loadProducts(): Collection
    {
        $query = Product::query()
            ->where('active', true)
            ->with('category');

        match ($this->filter_type) {
            'featured' => $query->where('featured', true),
            'promotional' => $query->whereNotNull('promotional_price_cents'),
            'new' => $query->latest('id'),
            'category' => $query->whereHas(
                'category',
                fn (Builder $q) => $q->whereIn('slug', $this->filter_values ?? [])
            ),
            'tag' => $query->whereIn('tag', $this->filter_values ?? []),
            'occasion' => $query->whereIn('occasion', $this->filter_values ?? []),
            'collection' => $query->whereHas(
                'collection',
                fn (Builder $q) => $q->whereIn('slug', $this->filter_values ?? [])
            ),
            default => null,
        };

        match ($this->order_by) {
            'featured' => $query->orderBy('featured', 'desc')->orderBy('order'),
            'price_asc' => $query->orderBy('price_cents'),
            'price_desc' => $query->orderBy('price_cents', 'desc'),
            'oldest' => $query->oldest('id'),
            default => $query->latest('id'),
        };

        return $query->limit($this->limit)->get();
    }

    private function loadBanners(): Collection
    {
        $query = Banner::where('active', true)->orderBy('order');

        if ($this->filter_type === 'collection' && ! empty($this->filter_values)) {
            $query->whereHas(
                'collection',
                fn (Builder $q) => $q->whereIn('slug', $this->filter_values)
            );
        }

        return $query->limit($this->limit)->get();
    }

    private function loadCollections(): Collection
    {
        $query = FashionCollection::where('active', true);

        if ($this->filter_type === 'featured') {
            $query->where('featured', true);
        } elseif ($this->filter_type === 'collection' && ! empty($this->filter_values)) {
            $query->whereIn('slug', $this->filter_values);
        }

        return $query->orderBy('order')->limit($this->limit)->get();
    }

    /** Gera a URL do botão "Ver todos" — usa a custom se preenchida, senão auto-gera. */
    public function viewAllUrl(): string
    {
        if (! empty($this->view_all_url)) {
            return $this->view_all_url;
        }

        $values = $this->filter_values ?? [];

        return match ($this->filter_type) {
            'featured' => route('catalog.featured'),
            'promotional' => route('catalog.sale'),
            'new' => route('catalog.new'),
            'category' => count($values) === 1
                ? route('catalog.category', ['category' => $values[0]])
                : route('catalog.search').'?'.http_build_query(['categorias' => $values]),
            'tag' => count($values) === 1
                ? route('catalog.tag', ['tag' => $values[0]])
                : route('catalog.search').'?'.http_build_query(['tags' => $values]),
            'occasion' => count($values) === 1
                ? route('catalog.occasion', ['occasion' => $values[0]])
                : route('catalog.search').'?'.http_build_query(['ocasioes' => $values]),
            'collection' => count($values) === 1
                ? route('collection.show', ['slug' => $values[0]])
                : route('catalog.search').'?'.http_build_query(['colecoes' => $values]),
            'all' => route('catalog.search'),
            default => route('catalog.search'),
        };
    }
}
