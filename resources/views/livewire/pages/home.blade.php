@push('meta')
@php
    $organizationSchema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'ClothingStore',
        'name'            => "Verônica's Fashion",
        'description'     => "Boutique feminina especializada em moda premium, com peças exclusivas e elegantes para todas as ocasiões.",
        'url'             => route('home'),
        'logo'            => asset('web-app-manifest-512x512.png'),
        'image'           => asset('web-app-manifest-512x512.png'),
        'telephone'       => config('veronica.contact.phone'),
        'address'         => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => config('veronica.contact.address'),
            'addressCountry'  => 'BR',
        ],
        'contactPoint' => [
            '@type'       => 'ContactPoint',
            'contactType' => 'customer service',
            'telephone'   => config('veronica.contact.phone'),
            'availableLanguage' => 'Portuguese',
        ],
        'sameAs' => [
            'https://www.instagram.com/' . config('veronica.social.instagram'),
            'https://wa.me/' . config('veronica.whatsapp.number'),
        ],
    ];

    $websiteSchema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        'name'            => "Verônica's Fashion",
        'url'             => route('home'),
        'description'     => "Catálogo digital da Verônica's Fashion — boutique feminina premium.",
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => route('catalog.featured'),
            'query-input' => 'required name=search_term_string',
        ],
    ];
@endphp
<x-seo
    title="Verônica's Fashion - Catálogo de Moda Feminina"
    description="Descubra a elegância da Verônica's Fashion. Peças exclusivas de moda feminina premium: vestidos, conjuntos, acessórios e muito mais. Boutique feminina com atendimento personalizado."
    :url="route('home')"
    type="website"
    :json-ld="[$organizationSchema, $websiteSchema]"
/>
@endpush

<div>
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Header                                                              --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <x-page-header
        title="Catálogo"
        subtitle="Explore nossa seleção exclusiva"
    />

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Hero Carousel                                                       --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    @if ($banners->isNotEmpty())
        <div class="mb-16">
            <x-hero-carousel :banners="$banners" />
        </div>
    @endif

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
