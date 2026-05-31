{{--
    Destaque + Pilha ou Destaque + Lista.
    <x-home.section-highlight :section="$section" :favorites="$favorites" mode="stack" />
    mode: stack | list
--}}
@props([
    'section',
    'favorites' => [],
    'mode' => 'stack',
])

@php
    $products = $section->data;
    $featured = $products->first();
    $rest = $products->skip(1)->values();
@endphp

@if ($featured)
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
        {{-- Destaque (card padrão) --}}
        <div>
            <x-product-card
                :product="$featured"
                :is-favorite="in_array($featured->id, $favorites, true)"
            />
        </div>

        {{-- Pilha ou Lista --}}
        @if ($rest->isNotEmpty())
            @if ($mode === 'list')
                {{-- Lista compacta --}}
                <div class="flex flex-col gap-3">
                    @foreach ($rest->take(3) as $product)
                        <div class="bg-card rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                            <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="flex gap-0 group">
                                <div class="shrink-0 w-24 h-24 overflow-hidden bg-muted">
                                    <img
                                        src="{{ $product->primary_image ? Storage::disk('public')->url($product->primary_image) : '' }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="flex-1 min-w-0 p-3 flex flex-col justify-between">
                                    <div>
                                        <p class="text-[10px] text-muted-foreground font-sans uppercase tracking-wide mb-0.5">{{ $product->category?->name }}</p>
                                        <h3 class="font-serif text-sm group-hover:text-primary transition-colors line-clamp-2 leading-snug">{{ $product->name }}</h3>
                                    </div>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="font-sans text-sm text-primary">{{ $product->formatted_price }}</span>
                                        <span class="text-xs text-primary/70 font-sans">Ver →</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Pilha (stack) — 3 mini-cards verticais --}}
                <div class="flex flex-col gap-3">
                    @foreach ($rest->take(3) as $product)
                        <div class="bg-card rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden group">
                            <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="flex gap-0">
                                <div class="shrink-0 w-28 h-28 overflow-hidden bg-muted">
                                    <img
                                        src="{{ $product->primary_image ? Storage::disk('public')->url($product->primary_image) : '' }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="flex-1 min-w-0 p-4 flex flex-col justify-between">
                                    <div>
                                        @if ($product->tag)
                                            <span class="inline-block bg-primary/10 text-primary text-[10px] px-2 py-0.5 rounded-full font-sans mb-1">{{ $product->tag }}</span>
                                        @endif
                                        <h3 class="font-serif text-sm group-hover:text-primary transition-colors line-clamp-2 leading-snug">{{ $product->name }}</h3>
                                    </div>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="font-sans text-base text-primary">{{ $product->formatted_price }}</span>
                                        @if (!empty($product->sizes))
                                            <div class="flex gap-1">
                                                @foreach (array_slice($product->sizes, 0, 3) as $size)
                                                    <span class="text-[10px] bg-muted px-1.5 py-0.5 rounded font-sans">{{ $size }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
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
