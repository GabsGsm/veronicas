<div>
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Header                                                              --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <x-page-header
        title="Catálogo Premium"
        subtitle="Explore nossa seleção exclusiva"
    />

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Hero Carousel                                                       --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="mb-16">
        <x-hero-carousel :banners="$banners" />
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Destaques                                                           --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    @if ($featuredProducts->isNotEmpty())
        <section class="mb-16">
            <x-section-title
                title="Destaques da Semana"
                subtitle="Peças especialmente selecionadas para você"
            />
            <x-product-grid :products="$featuredProducts" :favorites="$favorites" />
            <div class="mt-8 text-center">
                <a href="{{ route('catalog.featured') }}" wire:navigate
                   class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all">
                    Ver mais
                    <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            </div>
        </section>
    @endif

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Nova Coleção                                                        --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    @if ($newCollection->isNotEmpty())
        <section class="mb-16">
            <x-section-title
                title="Nova Coleção"
                subtitle="As últimas tendências em moda feminina premium"
            />
            <x-product-grid :products="$newCollection" :favorites="$favorites" />
            <div class="mt-8 text-center">
                <a href="{{ route('catalog.new') }}" wire:navigate
                   class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all">
                    Ver mais
                    <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            </div>
        </section>
    @endif

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Promoções                                                           --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    @if ($promoProducts->isNotEmpty())
        <section class="mb-16">
            <x-section-title
                title="Promoções Especiais"
                subtitle="Aproveite ofertas exclusivas"
            />
            <x-product-grid :products="$promoProducts" :favorites="$favorites" />
            <div class="mt-8 text-center">
                <a href="{{ route('catalog.sale') }}" wire:navigate
                   class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all">
                    Ver mais
                    <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            </div>
        </section>
    @endif
</div>
