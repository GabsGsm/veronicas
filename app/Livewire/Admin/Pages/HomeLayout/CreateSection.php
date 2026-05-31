<?php

namespace App\Livewire\Admin\Pages\HomeLayout;

use App\Models\Category;
use App\Models\Collection;
use App\Models\HomeContainer;
use App\Models\HomeSection;
use App\Models\Occasion;
use App\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Nova Seção')]
class CreateSection extends Component
{
    public int $containerId;

    public string $title = '';

    public string $description = '';

    public string $componentType = 'cards';

    public string $dataSource = 'products';

    public string $filterType = 'all';

    /** @var array<int, string> */
    public array $filterValues = [];

    public string $orderBy = 'newest';

    public int $limit = 4;

    public bool $showTitle = true;

    public bool $showViewAll = false;

    public string $viewAllLabel = 'Ver mais';

    public string $viewAllUrl = '';

    public string $viewAllPosition = 'inline';

    public bool $active = true;

    public int $order = 0;

    public function mount(int $containerId): void
    {
        $this->containerId = $containerId;
        HomeContainer::findOrFail($containerId);
        $this->order = (HomeSection::where('home_container_id', $containerId)->max('order') ?? -1) + 1;
    }

    public function updatedComponentType(): void
    {
        $this->dataSource = self::dataSourceFor($this->componentType);
        $this->filterType = 'all';
        $this->filterValues = [];
    }

    public function updatedFilterType(): void
    {
        $this->filterValues = [];
    }

    public function applyUrlBuilder(string $url): void
    {
        $this->viewAllUrl = $url;
    }

    /** @return array<int, array{slug: string, name: string}> */
    public function urlBuilderItems(): array
    {
        return match ($this->filterType) {
            'category' => Category::where('active', true)->orderBy('name')->get(['name', 'slug'])
                ->map(fn ($c) => ['slug' => $c->slug, 'name' => $c->name])->all(),
            'tag' => Tag::where('active', true)->orderBy('name')->get(['name', 'slug'])
                ->map(fn ($t) => ['slug' => $t->slug, 'name' => $t->name])->all(),
            'occasion' => Occasion::where('active', true)->orderBy('name')->get(['name', 'slug'])
                ->map(fn ($o) => ['slug' => $o->slug, 'name' => $o->name])->all(),
            'collection' => Collection::where('active', true)->orderBy('title')->get(['title', 'slug'])
                ->map(fn ($c) => ['slug' => $c->slug, 'name' => $c->title])->all(),
            default => [],
        };
    }

    /** @return array<int, string> */
    public function filterValuesToBuilderSlugs(): array
    {
        if (empty($this->filterValues)) {
            return [];
        }

        return match ($this->filterType) {
            'tag' => Tag::whereIn('name', $this->filterValues)->pluck('slug')->all(),
            'occasion' => Occasion::whereIn('name', $this->filterValues)->pluck('slug')->all(),
            default => $this->filterValues,
        };
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'componentType' => 'required|in:'.implode(',', array_keys(config('veronica.home_component_types', []))),
            'filterType' => 'required|string',
            'limit' => 'required|integer|min:1|max:24',
            'order' => 'required|integer|min:0',
            'viewAllLabel' => 'nullable|string|max:100',
            'viewAllUrl' => 'nullable|url|max:500',
        ]);

        HomeSection::create([
            'home_container_id' => $this->containerId,
            'title' => $this->title ?: null,
            'description' => $this->description ?: null,
            'component_type' => $this->componentType,
            'data_source' => $this->dataSource,
            'filter_type' => $this->filterType,
            'filter_values' => ! empty($this->filterValues) ? $this->filterValues : null,
            'order_by' => $this->orderBy,
            'limit' => $this->limit,
            'show_title' => $this->showTitle,
            'show_view_all' => $this->showViewAll,
            'view_all_label' => $this->viewAllLabel ?: 'Ver mais',
            'view_all_url' => $this->viewAllUrl ?: null,
            'view_all_position' => $this->viewAllPosition,
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Seção criada com sucesso.');
        $this->redirect(route('admin.home-layout.index'), navigate: true);
    }

    public static function dataSourceFor(string $componentType): string
    {
        return match ($componentType) {
            'banner_carousel' => 'banners',
            'featured_collection', 'collection_grid', 'collection_list' => 'collections',
            default => 'products',
        };
    }

    public function render(): View
    {
        return view('livewire.admin.pages.home-layout.create-section', [
            'componentTypes' => config('veronica.home_component_types', []),
            'filterTypes' => config('veronica.home_filter_types', []),
            'categories' => Category::where('active', true)->orderBy('name')->get(),
            'tags' => Tag::where('active', true)->orderBy('name')->get(),
            'occasions' => Occasion::where('active', true)->orderBy('name')->get(),
            'collections' => Collection::where('active', true)->orderBy('title')->get(),
        ]);
    }
}
