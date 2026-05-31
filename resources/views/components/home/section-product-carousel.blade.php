{{--
    Carrossel de produtos — slide automático com controles e indicadores.
    <x-home.section-product-carousel :section="$section" :favorites="$favorites" />
--}}
@props([
    'section',
    'favorites' => [],
])

@php
    $products = $section->data;
@endphp

@if ($products->isNotEmpty())
<section class="mb-16" wire:key="section-{{ $section->id }}">
    @if ($section->show_title && $section->title)
        <div class="mb-6 flex items-end justify-between gap-4">
            <x-section-title :title="$section->title" :subtitle="$section->description" class="mb-0" />
            @if ($section->show_view_all && ($section->view_all_position ?? 'inline') === 'inline')
                <a href="{{ $section->viewAllUrl() }}" wire:navigate class="shrink-0 inline-flex items-center gap-1.5 text-sm font-sans text-primary hover:text-rose-700 transition-colors">
                    {{ $section->view_all_label }} <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            @endif
        </div>
    @endif

    {{-- Carrossel Alpine.js --}}
    <div
        x-data="{
            current: 0,
            total: {{ $products->count() }},
            timer: null,
            next() { this.current = (this.current + 1) % this.total; },
            prev() { this.current = (this.current - 1 + this.total) % this.total; },
            go(i) { this.current = i; this.restart(); },
            start() { this.timer = setInterval(() => this.next(), 4000); },
            restart() { clearInterval(this.timer); this.start(); }
        }"
        x-init="start()"
        @mouseenter="clearInterval(timer)"
        @mouseleave="restart()"
        class="relative"
    >
        {{-- Slides --}}
        <div class="relative overflow-hidden rounded-2xl">
            @foreach ($products as $index => $product)
                <div
                    x-show="current === {{ $index }}"
                    x-transition:enter="transition-opacity duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    style="display: none;"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                    wire:key="carousel-slide-{{ $section->id }}-{{ $index }}"
                >
                    {{-- Produto principal em destaque --}}
                    <div class="sm:col-span-2 lg:col-span-2">
                        <div class="relative rounded-2xl overflow-hidden bg-muted group" style="aspect-ratio: 3/2">
                            <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="block absolute inset-0">
                                <img
                                    src="{{ $product->primary_image ? Storage::disk('public')->url($product->primary_image) : '' }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                            </a>
                            <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/10 to-transparent pointer-events-none"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5">
                                @if ($product->tag)
                                    <span class="inline-block bg-primary text-white px-3 py-1 rounded-full text-xs font-sans mb-2">{{ $product->tag }}</span>
                                @endif
                                <h3 class="font-serif text-xl text-white mb-1 line-clamp-1">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-white/90 font-sans text-base">{{ $product->formatted_price }}</span>
                                    <a
                                        href="{{ route('product.show', $product->slug) }}"
                                        wire:navigate
                                        class="bg-white text-primary hover:bg-primary hover:text-white px-4 py-1.5 rounded-lg font-sans text-sm transition-all"
                                    >
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                            {{-- Botão favorito --}}
                            <div class="absolute top-4 right-4">
                                <div x-data="{ favorite: @js(in_array($product->id, $favorites, true)) }">
                                    <button
                                        type="button"
                                        @click.stop="favorite = !favorite; $dispatch('favorite-toggle', { id: {{ $product->id }} })"
                                        class="bg-white/90 backdrop-blur-sm p-2 rounded-full hover:bg-white transition-all"
                                    >
                                        <x-icon name="heart" class="w-5 h-5 transition-colors" ::class="favorite ? 'text-primary' : 'text-foreground'" ::fill="favorite ? 'currentColor' : 'none'" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Info + produto destaque compacto no lateral --}}
                    <div class="flex flex-col justify-between gap-4">
                        <div class="bg-card rounded-2xl p-5 flex-1 flex flex-col justify-between shadow-sm">
                            <div>
                                <p class="text-xs text-muted-foreground font-sans uppercase tracking-wide mb-1">{{ $product->category?->name }}</p>
                                <a href="{{ route('product.show', $product->slug) }}" wire:navigate>
                                    <h3 class="font-serif text-lg hover:text-primary transition-colors leading-snug mb-3">{{ $product->name }}</h3>
                                </a>
                                @if ($product->short_description)
                                    <p class="font-sans text-sm text-muted-foreground line-clamp-3 mb-4">{{ $product->short_description }}</p>
                                @endif
                                @if (!empty($product->sizes))
                                    <div class="flex flex-wrap gap-1.5 mb-4">
                                        @foreach (array_slice($product->sizes, 0, 5) as $size)
                                            <span class="text-xs bg-muted px-2 py-1 rounded font-sans">{{ $size }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if ($product->formatted_original_price)
                                    <span class="text-sm text-muted-foreground line-through font-sans block">{{ $product->formatted_original_price }}</span>
                                @endif
                                <span class="font-sans text-2xl text-primary font-medium">{{ $product->formatted_price }}</span>
                                <a
                                    href="{{ route('product.show', $product->slug) }}"
                                    wire:navigate
                                    class="mt-3 w-full inline-flex items-center justify-center bg-primary hover:bg-rose-600 text-white py-2.5 rounded-lg font-sans text-sm transition-all"
                                >
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>

                        {{-- Indicador de progresso --}}
                        <div class="flex items-center justify-center gap-2">
                            @foreach ($products as $i => $p)
                                <button
                                    type="button"
                                    @click="go({{ $i }})"
                                    class="h-1.5 rounded-full transition-all duration-300"
                                    :class="current === {{ $i }} ? 'w-6 bg-primary' : 'w-2 bg-primary/30 hover:bg-primary/50'"
                                    aria-label="Produto {{ $i + 1 }}"
                                ></button>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Controles de navegação --}}
        <button
            type="button"
            @click="prev(); restart();"
            class="absolute left-0 top-1/3 -translate-y-1/2 -translate-x-3 z-10 w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center text-foreground hover:bg-primary hover:text-white transition-all"
            aria-label="Produto anterior"
        >
            <x-icon name="chevron-left" class="w-5 h-5" />
        </button>
        <button
            type="button"
            @click="next(); restart();"
            class="absolute right-0 top-1/3 -translate-y-1/2 translate-x-3 z-10 w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center text-foreground hover:bg-primary hover:text-white transition-all"
            aria-label="Próximo produto"
        >
            <x-icon name="chevron-right" class="w-5 h-5" />
        </button>
    </div>

    @if ($section->show_view_all && ($section->view_all_position ?? 'inline') === 'bottom')
        <div class="mt-8 text-center">
            <a href="{{ $section->viewAllUrl() }}" wire:navigate class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all">
                {{ $section->view_all_label }} <x-icon name="arrow-right" class="w-4 h-4" />
            </a>
        </div>
    @endif
</section>
@endif
