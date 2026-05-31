{{--
    <x-product-card :product="$product" :is-favorite="$isFavorite" />

    Recebe um App\Models\Product. Toggle de favorito é despachado como evento
    Livewire 'favorite:toggle' que cada página captura conforme conveniência.
--}}
@props([
    'product',
    'isFavorite' => false,
])

<div
    x-data="{ favorite: @js($isFavorite) }"
    wire:key="product-card-{{ $product->id }}"
    class="bg-card rounded-xl overflow-hidden shadow-premium hover:shadow-premium-hover transition-all duration-300 group cursor-pointer hover:-translate-y-1 flex flex-col"
>
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Imagem + tags                                                        --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="relative aspect-3/4 overflow-hidden bg-muted">
        <a
            href="{{ route('product.show', $product->slug) }}"
            class="absolute inset-0 block"
            wire:navigate
        >
            <img
                src="{{ $product->primary_image ? Storage::disk('public')->url($product->primary_image) : '' }}"
                alt="{{ $product->name }}"
                loading="lazy"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            >
        </a>

        @if ($product->tag)
            <span class="absolute top-3 left-3 bg-primary text-white px-3 py-1 rounded-full text-xs font-sans z-10 pointer-events-none">
                {{ $product->tag }}
            </span>
        @endif

        {{-- Botão de favorito — fora do <a> para não disparar navegação --}}
        <button
            type="button"
            @click.stop="favorite = !favorite; $dispatch('favorite-toggle', { id: {{ $product->id }} })"
            class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-2 rounded-full hover:bg-white transition-all z-10"
            aria-label="Favoritar {{ $product->name }}"
        >
            <x-icon
                name="heart"
                class="w-5 h-5 transition-colors"
                ::class="favorite ? 'text-primary' : 'text-foreground'"
                ::fill="favorite ? 'currentColor' : 'none'"
            />
        </button>

        @if ($product->isOnSale())
            <span class="absolute bottom-3 right-3 bg-destructive text-white px-3 py-1 rounded-full text-xs font-sans z-10 pointer-events-none">
                Promoção
            </span>
        @endif
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Conteúdo                                                              --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="p-4 flex flex-col flex-1">
        <p class="text-xs text-muted-foreground font-sans uppercase tracking-wide mb-1">
            {{ $product->category?->name ?? '—' }}
        </p>

        <h3 class="font-serif text-lg mb-2 line-clamp-1">
            {{ $product->name }}
        </h3>

        <div class="flex items-baseline gap-2 mb-3">
            @if ($product->formatted_original_price)
                <span class="text-sm text-muted-foreground line-through font-sans">
                    {{ $product->formatted_original_price }}
                </span>
            @endif
            <span class="font-sans text-xl text-primary">
                {{ $product->formatted_price }}
            </span>
        </div>

        @if (! empty($product->sizes))
            <div class="flex flex-wrap gap-1.5 mb-4">
                @foreach (array_slice($product->sizes, 0, 4) as $size)
                    <span class="text-xs bg-muted px-2 py-1 rounded font-sans">{{ $size }}</span>
                @endforeach
            </div>
        @endif

        <a
            href="{{ route('product.show', $product->slug) }}"
            wire:navigate
            class="mt-auto w-full inline-flex items-center justify-center bg-primary hover:bg-rose-600 text-white py-2.5 rounded-lg font-sans text-sm transition-all"
        >
            Ver Detalhes
        </a>
    </div>
</div>
