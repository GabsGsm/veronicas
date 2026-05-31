{{--
    Grade Elevada — cards em container elevado com decorações e badge de destaque.
    <x-home.section-high-grid :section="$section" :favorites="$favorites" />
--}}
@props([
    'section',
    'favorites' => [],
])

<section class="mb-16" wire:key="section-{{ $section->id }}">
    <div class="relative bg-card border border-border rounded-2xl overflow-hidden py-10 px-6 md:px-10">
        {{-- Orbs decorativos --}}
        <div class="absolute -top-16 -right-16 w-64 h-64 rounded-full blur-3xl opacity-5 pointer-events-none bg-primary"></div>
        <div class="absolute -bottom-16 -left-16 w-56 h-56 rounded-full blur-3xl opacity-5 pointer-events-none bg-primary"></div>

        {{-- Cabeçalho --}}
        @if ($section->show_title && $section->title)
            <div class="mb-8 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-8 rounded-full bg-primary"></div>
                    <div>
                        <h2 class="font-serif text-3xl tracking-tight">{{ $section->title }}</h2>
                        @if ($section->description)
                            <p class="text-muted-foreground font-sans text-sm mt-0.5">{{ $section->description }}</p>
                        @endif
                    </div>
                    <span class="ml-2 px-2.5 py-0.5 text-[10px] font-sans font-semibold tracking-wider uppercase rounded-full bg-primary/10 text-primary border border-primary/20">
                        TREND
                    </span>
                </div>
                @if ($section->show_view_all && ($section->view_all_position ?? 'inline') === 'inline')
                    <a href="{{ $section->viewAllUrl() }}" wire:navigate class="shrink-0 inline-flex items-center gap-1.5 text-sm font-sans text-primary hover:text-rose-700 transition-colors">
                        {{ $section->view_all_label }} <x-icon name="arrow-right" class="w-4 h-4" />
                    </a>
                @endif
            </div>
        @endif

        {{-- Grade de produtos --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach ($section->data as $i => $product)
                <div class="relative">
                    @if ($loop->first)
                        <span class="absolute top-3 left-3 z-20 px-2.5 py-0.5 text-xs font-sans font-semibold bg-primary text-white rounded-full pointer-events-none">
                            ✦ HOT
                        </span>
                    @endif
                    <x-product-card
                        :product="$product"
                        :is-favorite="in_array($product->id, $favorites, true)"
                    />
                </div>
            @endforeach
        </div>
    </div>

    @if ($section->show_view_all && ($section->view_all_position ?? 'inline') === 'bottom')
        <div class="mt-6 text-center">
            <a href="{{ $section->viewAllUrl() }}" wire:navigate class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all">
                {{ $section->view_all_label }} <x-icon name="arrow-right" class="w-4 h-4" />
            </a>
        </div>
    @endif
</section>
