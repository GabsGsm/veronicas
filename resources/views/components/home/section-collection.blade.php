{{--
    Seção de coleções — suporta layouts: hero (featured_collection), grid, list.
    <x-home.section-collection :section="$section" layout="hero" />
--}}
@props([
    'section',
    'layout' => 'hero',
])

@if ($section->data->isNotEmpty())
<section class="mb-16" wire:key="section-{{ $section->id }}">

    {{-- Cabeçalho (para grid e list) --}}
    @if ($layout !== 'hero' && $section->show_title && $section->title)
        <div class="mb-6 flex items-end justify-between gap-4">
            <x-section-title :title="$section->title" :subtitle="$section->description" class="mb-0" />
            @if ($section->show_view_all)
                <a href="{{ $section->viewAllUrl() }}" wire:navigate class="shrink-0 inline-flex items-center gap-1.5 text-sm font-sans text-primary hover:text-rose-700 transition-colors">
                    {{ $section->view_all_label }} <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            @endif
        </div>
    @endif

    @if ($layout === 'grid')
        {{-- ━━ Grade de cards de coleção ━━ --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($section->data as $collection)
                <a href="{{ route('collection.show', $collection->slug) }}" wire:navigate class="group block">
                    <div class="relative rounded-2xl overflow-hidden aspect-4/3 bg-muted">
                        @if ($collection->cover_image_url)
                            <img
                                src="{{ $collection->cover_image_url }}"
                                alt="{{ $collection->title }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                loading="lazy"
                            >
                        @else
                            <div class="absolute inset-0 bg-linear-to-br from-primary/30 to-rose-900/50"></div>
                        @endif
                        <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/20 to-transparent pointer-events-none"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            @if ($collection->subtitle)
                                <p class="text-white/70 font-script text-base mb-1">{{ $collection->subtitle }}</p>
                            @endif
                            <h3 class="font-serif text-xl text-white group-hover:text-rose-200 transition-colors">{{ $collection->title }}</h3>
                            <span class="inline-flex items-center gap-1 mt-2 text-xs font-sans text-white/80 group-hover:text-white transition-colors">
                                Ver coleção <x-icon name="arrow-right" class="w-3.5 h-3.5" />
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    @elseif ($layout === 'list')
        {{-- ━━ Lista de coleções ━━ --}}
        <div class="flex flex-col gap-4">
            @foreach ($section->data as $collection)
                <a href="{{ route('collection.show', $collection->slug) }}" wire:navigate class="group block">
                    <div class="flex gap-0 bg-card rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="shrink-0 w-36 sm:w-48 h-auto min-h-40 overflow-hidden bg-muted self-stretch">
                            @if ($collection->cover_image_url)
                                <img
                                    src="{{ $collection->cover_image_url }}"
                                    alt="{{ $collection->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full bg-linear-to-br from-primary/20 to-rose-900/30"></div>
                            @endif
                        </div>
                        <div class="flex flex-col justify-center py-6 pr-6 min-w-0">
                            @if ($collection->subtitle)
                                <p class="font-script text-lg text-primary mb-1">{{ $collection->subtitle }}</p>
                            @endif
                            <h3 class="font-serif text-2xl mb-2 group-hover:text-primary transition-colors">{{ $collection->title }}</h3>
                            @if ($collection->description)
                                <p class="font-sans text-sm text-muted-foreground line-clamp-2 mb-4">{{ $collection->description }}</p>
                            @endif
                            <span class="inline-flex items-center gap-2 text-sm font-sans text-primary">
                                Ver coleção <x-icon name="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    @else
        {{-- ━━ Hero (featured_collection) — banner por coleção ━━ --}}
        @if ($section->show_title && $section->title)
            <x-section-title :title="$section->title" :subtitle="$section->description" />
        @endif
        @foreach ($section->data as $collection)
            <div class="relative rounded-2xl overflow-hidden h-64 sm:h-80 md:h-96 lg:h-104 group mb-4 last:mb-0">
                @if ($collection->cover_image_url)
                    <img
                        src="{{ $collection->cover_image_url }}"
                        alt="{{ $collection->title }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        loading="lazy"
                    >
                @else
                    <div class="absolute inset-0 bg-linear-to-br from-primary/30 to-rose-900/50"></div>
                @endif
                <div class="absolute inset-0 bg-linear-to-r from-black/65 via-black/25 to-transparent pointer-events-none"></div>
                <div class="absolute inset-0 flex items-center p-8 md:p-14">
                    <div>
                        @if ($collection->subtitle)
                            <p class="text-white/70 font-script text-2xl mb-2">{{ $collection->subtitle }}</p>
                        @endif
                        <h3 class="font-serif text-3xl md:text-5xl text-white mb-3 leading-tight">{{ $collection->title }}</h3>
                        @if ($collection->description)
                            <p class="text-white/75 font-sans text-sm max-w-md mb-6 line-clamp-2">{{ $collection->description }}</p>
                        @endif
                        <a
                            href="{{ route('collection.show', $collection->slug) }}"
                            wire:navigate
                            class="inline-flex items-center gap-2 bg-white text-primary hover:bg-primary hover:text-white px-7 py-3 rounded-full font-sans text-sm transition-all"
                        >
                            Ver Coleção <x-icon name="arrow-right" class="w-4 h-4" />
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</section>
@endif
