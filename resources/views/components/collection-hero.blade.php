{{--
    <x-collection-hero :collection="$collection" :product-count="$count" />
--}}
@props([
    'collection',
    'productCount' => 0,
])

<div class="relative h-[500px] md:h-[600px] rounded-3xl overflow-hidden bg-card shadow-premium mb-16">
    {{-- Background --}}
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $collection->banner_image }}')">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30"></div>
    </div>

    {{-- Content --}}
    <div class="relative h-full flex flex-col justify-end p-8 md:p-16 text-white animate-fade-in-up">
        <p class="font-script text-3xl md:text-4xl mb-3 opacity-90">
            {{ $collection->subtitle }}
        </p>

        <h1 class="font-serif text-4xl md:text-6xl mb-6 leading-tight tracking-tight">
            {{ $collection->title }}
        </h1>

        <p class="font-sans text-lg md:text-xl mb-8 max-w-2xl leading-relaxed opacity-95">
            {{ $collection->description }}
        </p>

        <div class="flex flex-wrap items-center gap-3 md:gap-6">
            <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                <x-icon name="sparkles" class="w-4 h-4" />
                <span class="font-sans text-sm">Coleção Especial</span>
            </div>
            <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                <span class="font-sans text-sm">{{ $productCount }} peças exclusivas</span>
            </div>
        </div>
    </div>
</div>
