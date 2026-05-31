@push('meta')
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $productUrl   = route('product.show', $product->slug);
    $productImage = $product->primary_image
        ? url(Storage::disk('public')->url($product->primary_image))
        : asset('web-app-manifest-512x512.png');

    $metaTitle = $product->name . " | Verônica's Fashion";
    $metaDesc  = $product->short_description
        ?? Str::limit(strip_tags($product->description ?? ''), 160)
        ?: "Confira {$product->name} na Verônica's Fashion. Moda feminina premium com elegância e sofisticação.";

    $price = number_format(
        ($product->promotional_price_cents ?? $product->price_cents) / 100,
        2, '.', ''
    );

    // Todas as imagens da galeria como URLs absolutas
    $allImages = array_map(fn ($img) => url($img), $product->images);

    $productSchema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Product',
        'name'     => $product->name,
        'url'      => $productUrl,
        'image'    => $allImages,
        'description' => strip_tags($product->description ?? $product->short_description ?? ''),
        'brand' => [
            '@type' => 'Brand',
            'name'  => "Verônica's Fashion",
        ],
        'offers' => [
            '@type'         => 'Offer',
            'price'         => $price,
            'priceCurrency' => 'BRL',
            'availability'  => 'https://schema.org/InStock',
            'url'           => $productUrl,
            'seller'        => [
                '@type' => 'Organization',
                'name'  => "Verônica's Fashion",
            ],
        ],
    ];

    if ($product->category) {
        $productSchema['category'] = $product->category->name;
    }
    if (!empty($product->sizes)) {
        $productSchema['size'] = implode(', ', $product->sizes);
    }
    if ($product->fabric) {
        $productSchema['material'] = $product->fabric;
    }
    if ($product->promotional_price_cents) {
        $productSchema['offers']['priceValidUntil'] = now()->addMonths(3)->toDateString();
    }

    // Breadcrumb
    $breadcrumbItems = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Início', 'item' => route('home')],
    ];
    $pos = 2;
    if ($collection) {
        $breadcrumbItems[] = [
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => $collection->title,
            'item'     => route('collection.show', $collection->slug),
        ];
    } elseif ($product->category) {
        $breadcrumbItems[] = [
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => $product->category->name,
            'item'     => route('catalog.category', $product->category->slug),
        ];
    }
    $breadcrumbItems[] = [
        '@type'    => 'ListItem',
        'position' => $pos,
        'name'     => $product->name,
        'item'     => $productUrl,
    ];

    $breadcrumbSchema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $breadcrumbItems,
    ];
@endphp
<x-seo
    :title="$metaTitle"
    :description="$metaDesc"
    :image="$productImage"
    :url="$productUrl"
    type="product"
    :json-ld="[$productSchema, $breadcrumbSchema]"
/>
@endpush

<div class="max-w-7xl mx-auto">
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Breadcrumb / Voltar                                                 --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="mb-8">
        <a
            href="{{ url()->previous() === url()->current() ? route('home') : url()->previous() }}"
            class="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground font-sans text-sm transition-colors"
        >
            <x-icon name="arrow-left" class="w-4 h-4" />
            Voltar
        </a>

        @if ($collection)
            <div class="mt-2 flex items-center gap-2 text-sm">
                <span class="text-muted-foreground font-sans">Coleção:</span>
                <a
                    href="{{ route('collection.show', $collection->slug) }}"
                    wire:navigate
                    class="text-primary hover:underline font-script text-lg"
                >
                    {{ $collection->title }}
                </a>
            </div>
        @endif
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Grid principal                                                      --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-16">
        {{-- Galeria --}}
        <div>
            <x-product-gallery
                :images="$product->images"
                :name="$product->name"
            />
        </div>

        {{-- Informações --}}
        <div class="space-y-6"
             x-data="{ selectedSize: '', selectedColor: '' }"
             @size-selected="selectedSize = $event.detail"
             @color-selected="selectedColor = $event.detail">
            <div>
                <p class="text-sm text-muted-foreground font-sans uppercase tracking-wide mb-2">
                    {{ $product->category?->name }}
                </p>
                <h1 class="font-serif text-3xl md:text-4xl mb-4 tracking-tight">
                    {{ $product->name }}
                </h1>

                {{-- Tags --}}
                <div class="flex flex-wrap gap-2 mb-4">
                    @if ($product->tag)
                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-sans">
                            {{ $product->tag }}
                        </span>
                    @endif
                    @if ($product->featured)
                        <span class="bg-accent text-accent-foreground px-3 py-1 rounded-full text-xs font-sans flex items-center gap-1">
                            <x-icon name="sparkles" class="w-3 h-3" />
                            Destaque
                        </span>
                    @endif
                </div>

                {{-- Preço --}}
                <div class="flex items-baseline gap-3 mb-6">
                    @if ($product->formatted_original_price)
                        <span class="text-lg text-muted-foreground line-through font-sans">
                            {{ $product->formatted_original_price }}
                        </span>
                    @endif
                    <span class="font-serif text-3xl md:text-4xl text-primary">
                        {{ $product->formatted_price }}
                    </span>
                </div>
            </div>

            {{-- Descrição --}}
            @if ($product->description)
                <div class="border-t border-border pt-6">
                    <p class="text-foreground/90 font-sans leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>
            @endif

            {{-- Seletores --}}
            <div class="border-t border-border pt-6 space-y-6">
                @if (! empty($product->sizes))
                    <x-size-selector :sizes="$product->sizes" />
                @endif

                @if (! empty($product->colors))
                    <x-color-selector :colors="$product->colors" />
                @endif
            </div>

            {{-- CTA WhatsApp --}}
            <div class="border-t border-border pt-6">
                <x-whatsapp-cta
                    :product-name="$product->name"
                    :product-price="$product->formatted_price"
                />
                <p class="text-xs text-center text-muted-foreground mt-3 font-sans">
                    Atendimento personalizado • Consultoria de estilo incluída
                </p>
            </div>

            {{-- Botão favoritar --}}
            <button
                type="button"
                x-data="{ fav: @js(in_array($product->id, session('favorites', []), true)) }"
                @click="fav = !fav; $dispatch('favorite-toggle', { id: {{ $product->id }} })"
                class="w-full border-2 hover:border-primary py-3 px-6 rounded-full font-sans text-sm transition-all flex items-center justify-center gap-2"
                :class="fav ? 'border-primary text-primary bg-primary/5' : 'border-border text-foreground hover:text-primary'"
            >
                <x-icon
                    name="heart"
                    class="w-4 h-4"
                    ::fill="fav ? 'currentColor' : 'none'"
                />
                <span x-text="fav ? 'Adicionado aos Favoritos' : 'Adicionar aos Favoritos'"></span>
            </button>
        </div>
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Detalhes do produto                                                 --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 bg-editorial-rose rounded-2xl p-8">
        @if ($product->fabric)
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                    <x-icon name="package" class="w-6 h-6 text-primary" />
                </div>
                <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-2">
                    Tecido
                </h3>
                <p class="font-sans text-sm">{{ $product->fabric }}</p>
                @if ($product->fabric_details)
                    <p class="text-xs text-muted-foreground mt-1 font-sans">
                        {{ $product->fabric_details }}
                    </p>
                @endif
            </div>
        @endif

        @if ($product->occasion)
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                    <x-icon name="sparkles" class="w-6 h-6 text-primary" />
                </div>
                <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-2">
                    Ocasião
                </h3>
                <p class="font-sans text-sm">{{ $product->occasion }}</p>
            </div>
        @endif

        @if (! empty($product->care))
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                    <x-icon name="shield" class="w-6 h-6 text-primary" />
                </div>
                <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-2">
                    Cuidados
                </h3>
                <ul class="text-xs text-muted-foreground space-y-1 font-sans">
                    @foreach (array_slice($product->care, 0, 3) as $item)
                        <li>• {{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Produtos relacionados                                               --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    @if ($related->isNotEmpty())
        <div class="border-t border-border pt-12">
            <div class="mb-8 text-center">
                <h2 class="font-serif text-3xl mb-2 tracking-tight">Complete o Look</h2>
                <p class="text-muted-foreground font-sans">
                    Peças selecionadas especialmente para combinar
                </p>
            </div>
            <x-product-grid :products="$related" />
        </div>
    @endif
</div>
