{{--
    <x-product-grid :products="$products" empty-message="Nada por aqui ainda" :favorites="$favorites" />

    Grid responsivo:
      mobile  → 1 col
      sm      → 2 cols
      lg      → 3 cols
      xl      → 4 cols
--}}
@props([
    'products',
    'emptyMessage' => 'Nenhum produto encontrado',
    'favorites' => [],
])

@if (count($products) === 0)
    <div class="text-center py-20 bg-card rounded-2xl">
        <x-icon name="sparkles" class="w-12 h-12 text-muted-foreground/40 mx-auto mb-4" />
        <p class="text-muted-foreground font-sans text-lg">{{ $emptyMessage }}</p>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6']) }}>
        @foreach ($products as $product)
            <x-product-card
                :product="$product"
                :is-favorite="in_array($product->id, $favorites, true)"
            />
        @endforeach
    </div>
@endif
