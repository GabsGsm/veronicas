<div>
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Top bar com filtros (desktop)                                       --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="hidden lg:flex items-center justify-end mb-8">
        <button
            type="button"
            @click="$dispatch('open-filters')"
            class="flex items-center gap-2 bg-primary hover:bg-rose-600 text-white px-6 py-3 rounded-full font-sans text-sm transition-all shadow-sm"
        >
            <x-icon name="filter" class="w-4 h-4" />
            Filtros
        </button>
    </div>

    <x-page-header
        :title="$config['title']"
        :subtitle="$config['subtitle']"
        :decorative="$config['decorative']"
    />

    <x-product-grid
        :products="$products"
        :favorites="$favorites"
        empty-message="Nenhum produto disponível nesta categoria no momento"
    />

    <x-pagination :paginator="$products" />
</div>
