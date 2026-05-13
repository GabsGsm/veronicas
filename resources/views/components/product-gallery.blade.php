{{--
    <x-product-gallery :images="$product->images" :name="$product->name" />
--}}
@props([
    'images',
    'name',
])

<div
    x-data="{
        selected: 0,
        zoomed: false,
        images: @js(array_values($images)),
        next() { this.selected = (this.selected + 1) % this.images.length; },
        prev() { this.selected = (this.selected - 1 + this.images.length) % this.images.length; }
    }"
    class="space-y-4"
>
    {{-- Imagem principal --}}
    <div class="relative aspect-[3/4] rounded-2xl overflow-hidden bg-muted group">
        <template x-for="(img, index) in images" :key="index">
            <img
                :src="img"
                :alt="`{{ $name }} - Imagem ${index + 1}`"
                x-show="selected === index"
                @click="zoomed = !zoomed"
                :class="zoomed ? 'scale-150 cursor-zoom-out' : 'cursor-zoom-in'"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500"
                x-transition:enter="transition-opacity duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                style="display: none;"
            >
        </template>

        {{-- Zoom button --}}
        <button
            type="button"
            @click="zoomed = !zoomed"
            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-10"
            aria-label="Zoom"
        >
            <x-icon name="zoom-in" class="w-5 h-5 text-foreground" />
        </button>

        {{-- Navegação só quando há mais de 1 imagem --}}
        @if (count($images) > 1)
            <button
                type="button"
                @click="prev"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 backdrop-blur-sm p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-10"
                aria-label="Anterior"
            >
                <x-icon name="chevron-left" class="w-6 h-6 text-foreground" />
            </button>

            <button
                type="button"
                @click="next"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 backdrop-blur-sm p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-10"
                aria-label="Próxima"
            >
                <x-icon name="chevron-right" class="w-6 h-6 text-foreground" />
            </button>

            {{-- Indicadores --}}
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                <template x-for="(_, index) in images" :key="index">
                    <button
                        type="button"
                        @click="selected = index"
                        :class="selected === index ? 'w-8 bg-white' : 'w-2 bg-white/50'"
                        class="h-2 rounded-full transition-all"
                    ></button>
                </template>
            </div>
        @endif
    </div>

    {{-- Thumbnails --}}
    @if (count($images) > 1)
        <div class="grid grid-cols-4 gap-3">
            @foreach ($images as $index => $img)
                <button
                    type="button"
                    @click="selected = {{ $index }}"
                    :class="selected === {{ $index }} ? 'ring-2 ring-primary ring-offset-2' : 'opacity-60 hover:opacity-100'"
                    class="aspect-square rounded-lg overflow-hidden transition-all"
                >
                    <img src="{{ $img }}" alt="{{ $name }} - thumb {{ $index + 1 }}" class="w-full h-full object-cover" loading="lazy">
                </button>
            @endforeach
        </div>
    @endif
</div>
