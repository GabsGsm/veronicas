{{--
    Mobile-only header. Top bar com brand + botão menu, drawer lateral abre por Alpine.
--}}
<div x-data="{ open: @entangle('menuOpen') }" class="lg:hidden">

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Top bar fixa                                                --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <header class="fixed top-0 inset-x-0 z-30 bg-sidebar/95 backdrop-blur-md border-b border-sidebar-border h-16 flex items-center justify-between px-4">
        <button type="button" @click="open = true" class="p-2 -ml-2 text-foreground hover:text-primary transition-colors" aria-label="Abrir menu">
            <x-icon name="menu" class="w-6 h-6" />
        </button>

        <a href="{{ route('home') }}" wire:navigate class="text-center">
            <h1 class="font-script text-2xl text-primary leading-none">Verônica's</h1>
            <p class="text-[10px] text-muted-foreground tracking-widest uppercase font-sans">Fashion</p>
        </a>

        @unless(request()->routeIs('home') || request()->routeIs('product.show') || request()->routeIs('contact'))
            <button type="button" @click="$dispatch('open-filters')" class="p-2 -mr-2 text-foreground hover:text-primary transition-colors" aria-label="Filtros">
                <x-icon name="filter" class="w-6 h-6" />
            </button>
        @else
            <div class="w-10"></div>
        @endunless
    </header>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Drawer lateral                                              --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <template x-teleport="body">
        <div
            x-show="open"
            x-transition.opacity
            class="fixed inset-0 z-50"
            style="display: none;"
            x-cloak
        >
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="open = false"></div>

            {{-- Drawer panel --}}
            <aside
                x-show="open"
                x-transition:enter="transition transform ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition transform ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="absolute left-0 top-0 h-full w-72 bg-sidebar shadow-2xl flex flex-col"
            >
                <div class="p-6 border-b border-sidebar-border flex items-center justify-between">
                    <div class="text-center flex-1">
                        <h1 class="font-script text-3xl text-primary leading-none">Verônica's</h1>
                        <p class="text-xs text-muted-foreground mt-1 tracking-widest uppercase font-sans">Fashion</p>
                    </div>
                    <button @click="open = false" class="p-2 -mr-2 hover:bg-muted rounded-full transition-colors" aria-label="Fechar menu">
                        <x-icon name="x" class="w-5 h-5" />
                    </button>
                </div>

                <nav class="flex-1 overflow-y-auto py-4 scrollbar-thin">
                    @foreach ($menuItems as $item)
                        @php
                            $params = $item['params'] ?? [];
                            $href = route($item['route'], $params);
                            $isActive = request()->routeIs($item['route']) && collect($params)->every(
                                fn ($v, $k) => request()->route($k) === $v
                            );
                        @endphp
                        <a
                            href="{{ $href }}"
                            wire:navigate
                            @click="open = false"
                            class="w-full flex items-center gap-3 px-6 py-3.5 transition-all duration-200 border-l-4
                                {{ $isActive
                                    ? 'bg-sidebar-accent text-sidebar-accent-foreground border-primary'
                                    : 'text-sidebar-foreground hover:bg-sidebar-accent/50 border-transparent' }}"
                        >
                            <x-icon :name="$item['icon']" class="w-5 h-5 flex-shrink-0" />
                            <span class="font-sans text-sm">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>

                <div class="p-4 border-t border-sidebar-border text-center">
                    <p class="text-xs text-muted-foreground font-sans">© {{ date('Y') }} Verônica's Fashion</p>
                </div>
            </aside>
        </div>
    </template>
</div>
