{{--
    <x-color-selector :colors="$product->colors" />
--}}
@props(['colors'])

@php
    $colorMap = [
        'Preto'        => '#111111',
        'Branco'       => '#FFFFFF',
        'Off-white'    => '#F5F5F0',
        'Cinza'        => '#9CA3AF',
        'Grafite'      => '#374151',
        'Nude'         => '#D6BFA9',
        'Bege'         => '#D2B48C',
        'Caramelo'     => '#B77943',
        'Marrom'       => '#6B4423',
        'Terracota'    => '#C96A4A',
        'Rosé'         => '#E8B4B8',
        'Rosa'         => '#EC4899',
        'Pink'         => '#DB2777',
        'Vermelho'     => '#DC2626',
        'Bordô'        => '#7F1D1D',
        'Laranja'      => '#F97316',
        'Coral'        => '#FB7185',
        'Amarelo'      => '#FACC15',
        'Mostarda'     => '#CA8A04',
        'Verde'        => '#16A34A',
        'Verde-oliva'  => '#556B2F',
        'Verde-menta'  => '#6EE7B7',
        'Azul'         => '#2563EB',
        'Azul-marinho' => '#1E3A8A',
        'Azul-bebê'    => '#93C5FD',
        'Lilás'        => '#C4B5FD',
        'Roxo'         => '#7C3AED',
        'Champagne'    => '#F7E7CE',
        'Dourado'      => '#D4AF37',
        'Prateado'     => '#C0C0C0',
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
