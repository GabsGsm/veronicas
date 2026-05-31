{{--
    Seção editorial — 1 destaque grande + até 3 itens secundários.
    <x-home.section-editorial :section="$section" :favorites="$favorites" />
--}}
@props([
    'section',
    'favorites' => [],
])

@php
    $products = $section->data;
    $featured = $products->first();
    $rest = $products->skip(1)->values();
@endphp

@if ($featured)
<section class="mb-16" wire:key="section-{{ $section->id }}">
    {{-- Cabeçalho --}}
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

    {{-- Layout editorial: featured ocupa mais espaço; sidebar aparece apenas quando há itens --}}
    <div @class([
        'grid gap-6',
        'grid-cols-1 lg:grid-cols-5' => $rest->isNotEmpty(),
        'grid-cols-1' => $rest->isEmpty(),
    ])>
        {{-- Destaque principal --}}
        <div @class(['lg:col-span-3' => $rest->isNotEmpty()])>
            <div class="relative rounded-2xl overflow-hidden bg-muted group" style="aspect-ratio: 4/3">
                <a href="{{ route('product.show', $featured->slug) }}" wire:navigate class="block absolute inset-0">
                    <img
                        src="{{ $featured->primary_image ? Storage::disk('public')->url($featured->primary_image) : '' }}"
                        alt="{{ $featured->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                    >
                </a>
                <div class="absolute inset-0 bg-linear-to-t from-black/65 via-black/10 to-transparent pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    @if ($featured->tag)
                        <span class="inline-block bg-primary text-white px-3 py-1 rounded-full text-xs font-sans mb-3">{{ $featured->tag }}</span>
                    @endif
                    <h3 class="font-serif text-2xl text-white mb-2 line-clamp-2">{{ $featured->name }}</h3>
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-white/90 font-sans text-lg">{{ $featured->formatted_price }}</span>
                        <a
                            href="{{ route('product.show', $featured->slug) }}"
                            wire:navigate
                            class="bg-white text-primary hover:bg-primary hover:text-white px-4 py-2 rounded-lg font-sans text-sm transition-all"
                        >
                            Ver Detalhes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar com produtos secundários --}}
        @if ($rest->isNotEmpty())
            <div class="lg:col-span-2 flex flex-col gap-4">
                @foreach ($rest->take(3) as $product)
                    <div class="bg-card rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                        <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="flex gap-0 group">
                            <div class="shrink-0 w-28 h-28 overflow-hidden bg-muted">
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
                                    <h4 class="font-serif text-sm group-hover:text-primary transition-colors line-clamp-2 leading-snug">{{ $product->name }}</h4>
                                </div>
                                <span class="font-sans text-sm text-primary mt-1">{{ $product->formatted_price }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
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
