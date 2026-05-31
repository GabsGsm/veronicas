{{--
    Seção de produtos — suporta layouts: cards, list, high_grid.
    <x-home.section-products :section="$section" :favorites="$favorites" layout="cards" />
--}}
@props([
    'section',
    'favorites' => [],
    'layout' => 'cards',
])

<section class="mb-16" wire:key="section-{{ $section->id }}">
    {{-- ━━ Cabeçalho ━━ --}}
    @if ($section->show_title && $section->title)
        <div class="mb-6 flex items-end justify-between gap-4">
            <x-section-title
                :title="$section->title"
                :subtitle="$section->description"
                class="mb-0"
            />
            @if ($section->show_view_all && ($section->view_all_position ?? 'inline') === 'inline')
                <a
                    href="{{ $section->viewAllUrl() }}"
                    wire:navigate
                    class="shrink-0 inline-flex items-center gap-1.5 text-sm font-sans text-primary hover:text-rose-700 transition-colors"
                >
                    {{ $section->view_all_label }}
                    <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            @endif
        </div>
    @endif

    {{-- ━━ Grade/lista de produtos ━━ --}}
    @if ($layout === 'list')
        <div class="flex flex-col gap-4">
            @foreach ($section->data as $product)
                <div class="bg-card rounded-xl p-4 flex gap-4 shadow-sm hover:shadow-md transition-shadow">
                    <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="shrink-0 w-20 h-20 rounded-lg overflow-hidden bg-muted">
                        <img
                            src="{{ $product->primary_image ? Storage::disk('public')->url($product->primary_image) : '' }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                        >
                    </a>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-muted-foreground font-sans uppercase tracking-wide mb-0.5">{{ $product->category?->name }}</p>
                        <a href="{{ route('product.show', $product->slug) }}" wire:navigate>
                            <h3 class="font-serif text-base hover:text-primary transition-colors line-clamp-1">{{ $product->name }}</h3>
                        </a>
                        <div class="flex items-baseline gap-2 mt-1">
                            @if ($product->formatted_original_price)
                                <span class="text-xs text-muted-foreground line-through font-sans">{{ $product->formatted_original_price }}</span>
                            @endif
                            <span class="font-sans text-base text-primary">{{ $product->formatted_price }}</span>
                        </div>
                    </div>
                    <a
                        href="{{ route('product.show', $product->slug) }}"
                        wire:navigate
                        class="shrink-0 self-center text-xs bg-primary text-white px-3 py-2 rounded-lg hover:bg-rose-600 transition-colors font-sans"
                    >
                        Ver
                    </a>
                </div>
            @endforeach
        </div>
    @else
        {{-- cards (padrão) --}}
        <x-product-grid :products="$section->data" :favorites="$favorites" />
    @endif

    {{-- ━━ Botão "Ver mais" na base (posição bottom) ━━ --}}
    @if ($section->show_view_all && ($section->view_all_position ?? 'inline') === 'bottom')
        <div class="mt-8 text-center">
            <a
                href="{{ $section->viewAllUrl() }}"
                wire:navigate
                class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all"
            >
                {{ $section->view_all_label }}
                <x-icon name="arrow-right" class="w-4 h-4" />
            </a>
        </div>
    @endif
</section>
