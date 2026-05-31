{{--
    Sidebar fixa — premium boutique editorial.
    Em desktop (>=lg) mostra a sidebar tradicional 64. Em mobile, esconde
    (mostra apenas via MobileHeader).
--}}
<aside class="hidden lg:flex w-64 h-screen bg-sidebar border-r border-sidebar-border flex-col fixed left-0 top-0 z-30">

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Logo / Brand                                              --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="p-6 border-b border-sidebar-border">
        <a href="{{ route('home') }}" wire:navigate class="block text-center group">
            <h1 class="font-script text-3xl text-primary leading-none group-hover:opacity-80 transition-opacity">
                Verônica's
            </h1>
            <p class="text-xs text-muted-foreground mt-1 tracking-widest uppercase font-sans">
                Fashion
            </p>
        </a>
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Navegação                                                 --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <nav class="flex-1 overflow-y-auto py-4 scrollbar-thin">
        @foreach ($menuItems as $item)
            @php
                $href = $item->url();
                $isActive = request()->url() === $href || request()->fullUrl() === $href;
            @endphp

            <a
                href="{{ $href }}"
                wire:navigate
                class="w-full flex items-center gap-3 px-6 py-3.5 transition-all duration-200 group
                    {{ $isActive
                        ? 'bg-sidebar-accent text-sidebar-accent-foreground border-l-4 border-primary'
                        : 'text-sidebar-foreground hover:bg-sidebar-accent/50 border-l-4 border-transparent' }}"
            >
                @if ($item->icon)
                    <x-icon :name="$item->icon" class="w-5 h-5 shrink-0" />
                @endif
                <span class="font-sans text-sm">{{ $item->label }}</span>
            </a>
        @endforeach
    </nav>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Footer                                                    --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="p-4 border-t border-sidebar-border text-center">
        <p class="text-xs text-muted-foreground font-sans">© {{ date('Y') }} Verônica's Fashion</p>
        <p class="text-xs text-muted-foreground font-sans mt-1">Boutique Premium</p>
    </div>
</aside>
