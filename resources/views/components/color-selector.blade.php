{{--
    <x-color-selector :colors="$product->colors" />
--}}
@props(['colors'])

@php
    $colorMap = [
        'Rosé'      => '#e89b9b',
        'Nude'      => '#f5e8e4',
        'Off-white' => '#faf9f7',
        'Bege'      => '#f2ede9',
        'Branco'    => '#ffffff',
        'Champagne' => '#f7e7ce',
        'Dourado'   => '#d4af37',
        'Prateado'  => '#d4d4d4',
    ];
@endphp

<div x-data="{ selected: null }">
    <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
        Cor
    </h3>
    <div class="flex flex-wrap gap-3">
        @foreach ($colors as $color)
            <button
                type="button"
                @click="selected = '{{ $color }}'; $dispatch('color-selected', '{{ $color }}')"
                :class="selected === '{{ $color }}'
                    ? 'border-primary bg-primary/5'
                    : 'border-border hover:border-primary/50'"
                class="group relative flex items-center gap-2 px-4 py-3 rounded-lg border-2 transition-all"
            >
                <span
                    class="w-6 h-6 rounded-full border-2 border-border flex items-center justify-center"
                    style="background-color: {{ $colorMap[$color] ?? '#e5e7eb' }}"
                >
                    <span x-show="selected === '{{ $color }}'" x-cloak>
                        <x-icon name="check" class="w-4 h-4 text-primary" stroke-width="3" />
                    </span>
                </span>
                <span class="font-sans text-sm">{{ $color }}</span>
            </button>
        @endforeach
    </div>
</div>
