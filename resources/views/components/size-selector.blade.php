{{--
    <x-size-selector :sizes="$product->sizes" />
--}}
@props(['sizes'])

<div x-data="{ selected: null }">
    <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
        Tamanho
    </h3>
    <div class="flex flex-wrap gap-2">
        @foreach ($sizes as $size)
            <button
                type="button"
                @click="selected = '{{ $size }}'; $dispatch('size-selected', '{{ $size }}')"
                :class="selected === '{{ $size }}'
                    ? 'bg-primary text-white border-primary'
                    : 'bg-card border-border hover:border-primary hover:bg-primary/5'"
                class="px-5 py-3 rounded-lg font-sans text-sm transition-all border-2"
            >
                {{ $size }}
            </button>
        @endforeach
    </div>
</div>
