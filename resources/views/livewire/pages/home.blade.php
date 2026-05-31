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
    {{-- Seções dinâmicas da Home                                            --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    @foreach ($containers as $container)
        @foreach ($container->sections as $section)
            @if ($section->data->isNotEmpty())
                @switch($section->component_type)
                    @case('cards')
                        <x-home.section-products :$section :$favorites layout="cards" />
                        @break
                    @case('list')
                        <x-home.section-products :$section :$favorites layout="list" />
                        @break
                    @case('high_grid')
                        <x-home.section-high-grid :$section :$favorites />
                        @break
                    @case('editorial')
                        <x-home.section-editorial :$section :$favorites />
                        @break
                    @case('highlight_stack')
                        <x-home.section-highlight :$section :$favorites mode="stack" />
                        @break
                    @case('highlight_list')
                        <x-home.section-highlight :$section :$favorites mode="list" />
                        @break
                    @case('product_carousel')
                        <x-home.section-product-carousel :$section :$favorites />
                        @break
                    @case('banner_carousel')
                        <x-home.section-banner-carousel :$section />
                        @break
                    @case('featured_collection')
                        <x-home.section-collection :$section layout="hero" />
                        @break
                    @case('collection_grid')
                        <x-home.section-collection :$section layout="grid" />
                        @break
                    @case('collection_list')
                        <x-home.section-collection :$section layout="list" />
                        @break
                @endswitch
            @endif
        @endforeach
    @endforeach
</div>
