<div>
    @if ($isOpen)
        <div class="fixed inset-0 z-50">
            {{-- Backdrop --}}
            <div
                class="absolute inset-0 bg-black/20 backdrop-blur-sm animate-fade-in"
                wire:click="close"
            ></div>

            {{-- Painel --}}
            <aside class="absolute right-0 top-0 h-screen w-80 max-w-[90vw] bg-card shadow-2xl overflow-y-auto animate-slide-in-right scrollbar-thin">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-serif text-2xl">Filtros</h2>
                        <button
                            type="button"
                            wire:click="close"
                            class="p-2 hover:bg-muted rounded-full transition-colors"
                            aria-label="Fechar filtros"
                        >
                            <x-icon name="x" class="w-5 h-5" />
                        </button>
                    </div>

                    {{-- Tamanho --}}
                    <div class="mb-6">
                        <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
                            Tamanho
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($filterOptions['sizes'] as $size)
                                <button
                                    type="button"
                                    wire:click="toggleSize('{{ $size }}')"
                                    @class([
                                        'px-4 py-2 border rounded-lg font-sans text-sm transition-colors',
                                        'border-primary bg-primary text-white' => in_array($size, $selectedSizes, true),
                                        'border-border hover:border-primary hover:text-primary' => ! in_array($size, $selectedSizes, true),
                                    ])
                                >
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Cor --}}
                    <div class="mb-6">
                        <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
                            Cor
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($filterOptions['colors'] as $color)
                                <button
                                    type="button"
                                    wire:click="toggleColor('{{ $color }}')"
                                    @class([
                                        'px-3 py-2 border rounded-lg transition-colors font-sans text-xs',
                                        'border-primary bg-primary/10 text-primary' => in_array($color, $selectedColors, true),
                                        'border-border hover:border-primary hover:bg-primary/5' => ! in_array($color, $selectedColors, true),
                                    ])
                                >
                                    {{ $color }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Ocasião --}}
                    <div class="mb-6">
                        <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
                            Ocasião
                        </h3>
                        <div class="space-y-2">
                            @foreach ($filterOptions['occasions'] as $occasion)
                                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors">
                                    <input
                                        type="checkbox"
                                        wire:click="toggleOccasion('{{ $occasion }}')"
                                        @checked(in_array($occasion, $selectedOccasions, true))
                                        class="w-4 h-4 rounded border-border text-primary focus:ring-primary"
                                    >
                                    <span class="font-sans text-sm">{{ $occasion }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Preço --}}
                    <div class="mb-6">
                        <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
                            Faixa de Preço
                        </h3>
                        <div class="space-y-2">
                            @foreach ($filterOptions['priceRanges'] as $range)
                                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors">
                                    <input
                                        type="radio"
                                        name="price"
                                        value="{{ $range['label'] }}"
                                        wire:model.live="selectedPriceRange"
                                        class="w-4 h-4 border-border text-primary focus:ring-primary"
                                    >
                                    <span class="font-sans text-sm">{{ $range['label'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Ações --}}
                    <div class="flex gap-3 mt-8">
                        <button
                            type="button"
                            wire:click="clearAll"
                            class="flex-1 bg-muted hover:bg-muted/80 text-foreground py-3 rounded-lg font-sans text-sm transition-all"
                        >
                            Limpar
                        </button>
                        <button
                            type="button"
                            wire:click="apply"
                            class="flex-1 bg-primary hover:bg-rose-600 text-white py-3 rounded-lg font-sans text-sm transition-all"
                        >
                            Aplicar
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    @endif
</div>
