{{--
    <x-pagination :paginator="$products" />

    Componente de paginação no estilo rosé do site.
    Compatível com LengthAwarePaginator do Laravel.
--}}
@props(['paginator'])

@if ($paginator->hasPages())
    <nav class="mt-12 flex items-center justify-center gap-1 font-sans" aria-label="Paginação">

        {{-- Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-muted-foreground/40 cursor-not-allowed">
                <x-icon name="arrow-left" class="w-4 h-4" />
            </span>
        @else
            <a
                href="{{ $paginator->previousPageUrl() }}"
                wire:navigate
                class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-border text-foreground hover:border-primary hover:text-primary transition-all"
                aria-label="Página anterior"
            >
                <x-icon name="arrow-left" class="w-4 h-4" />
            </a>
        @endif

        {{-- Números de página --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page === $paginator->currentPage())
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary text-white text-sm font-medium shadow-sm">
                    {{ $page }}
                </span>
            @elseif (
                $page === 1 ||
                $page === $paginator->lastPage() ||
                abs($page - $paginator->currentPage()) <= 1
            )
                <a
                    href="{{ $url }}"
                    wire:navigate
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-border text-foreground hover:border-primary hover:text-primary text-sm transition-all"
                    aria-label="Página {{ $page }}"
                >
                    {{ $page }}
                </a>
            @elseif (
                $page === $paginator->currentPage() - 2 ||
                $page === $paginator->currentPage() + 2
            )
                <span class="inline-flex items-center justify-center w-10 h-10 text-muted-foreground text-sm">…</span>
            @endif
        @endforeach

        {{-- Próxima --}}
        @if ($paginator->hasMorePages())
            <a
                href="{{ $paginator->nextPageUrl() }}"
                wire:navigate
                class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-border text-foreground hover:border-primary hover:text-primary transition-all"
                aria-label="Próxima página"
            >
                <x-icon name="arrow-right" class="w-4 h-4" />
            </a>
        @else
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-muted-foreground/40 cursor-not-allowed">
                <x-icon name="arrow-right" class="w-4 h-4" />
            </span>
        @endif

    </nav>

    <p class="mt-4 text-center text-xs text-muted-foreground">
        {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} de {{ $paginator->total() }} {{ $paginator->total() === 1 ? 'peça' : 'peças' }}
    </p>
@endif
