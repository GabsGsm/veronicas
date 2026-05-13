<div class="max-w-7xl mx-auto">
    {{-- Hero Banner --}}
    <x-collection-hero
        :collection="$collection"
        :product-count="$collection->products->count()"
    />

    {{-- Grid Editorial --}}
    <div class="mb-16">
        @if ($collection->products->isEmpty())
            <div class="text-center py-20 bg-card rounded-2xl">
                <p class="text-muted-foreground font-sans text-lg">Esta coleção ainda não possui peças cadastradas.</p>
            </div>
        @else
            {{--
                Grid editorial — alterna cards normais com cards destaque (col-span/row-span).
                O padrão segue o React: posição 0 grande, 3 largo, demais normais.
            --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 auto-rows-fr gap-6">
                @foreach ($collection->products as $index => $product)
                    @php
                        $pattern = $index % 5;
                        $cls = match ($pattern) {
                            0 => 'sm:col-span-2 lg:col-span-2 lg:row-span-2',
                            3 => 'sm:col-span-2 lg:col-span-2',
                            default => '',
                        };
                    @endphp

                    <div class="{{ $cls }} animate-fade-in-up" style="animation-delay: {{ $index * 80 }}ms">
                        <x-product-card
                            :product="$product"
                            :is-favorite="in_array($product->id, $favorites, true)"
                        />
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Editorial Story --}}
    @if ($collection->story)
        <x-editorial-banner
            :story="$collection->story"
            :image="$collection->cover_image ? Storage::url($collection->cover_image) : null"
        />
    @endif

    {{-- Frase de encerramento --}}
    <div class="text-center py-16 bg-editorial-rose rounded-3xl mb-12">
        <p class="font-script text-3xl md:text-4xl text-primary mb-4">
            {{ $collection->subtitle }}
        </p>
        <p class="font-sans text-muted-foreground max-w-2xl mx-auto px-6">
            Uma coleção criada com dedicação e atenção aos detalhes.
            Cada peça conta uma história de elegância e sofisticação.
        </p>
    </div>
</div>
