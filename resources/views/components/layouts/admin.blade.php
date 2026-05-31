<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50" style="--color-accent:#be123c;--color-accent-foreground:#fff;--color-accent-content:#9f1239;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' | ' : '' }}Admin — Verônica's Fashion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full" x-data>

{{-- ━━━━ Toast global ━━━━ --}}
<div
    x-data="{ toasts: [] }"
    @toast.window="toasts.push({ ...($event.detail[0] ?? $event.detail), id: Date.now() }); setTimeout(() => toasts.shift(), 4000)"
    class="fixed top-4 right-4 z-[60] flex flex-col gap-2 w-80 pointer-events-none"
    aria-live="polite"
>
    <template x-for="t in toasts" :key="t.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="flex items-center gap-3 rounded-xl px-4 py-3 shadow-lg text-sm font-sans pointer-events-auto"
            :class="{
                'bg-emerald-500 text-white': t.type === 'success',
                'bg-red-500 text-white': t.type === 'error' || t.type === 'danger',
                'bg-amber-400 text-slate-900': t.type === 'warning',
                'bg-slate-800 text-white': !t.type || t.type === 'info',
            }"
        >
            <span x-text="t.message" class="flex-1"></span>
        </div>
    </template>
</div>

@if (session('cache_cleared'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { type: 'success', message: '✓ Config, cache e views limpos com sucesso!' }
            }));
        }, 150);
    });
</script>
@endif

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- Container principal — Alpine gerencia abertura do drawer mobile      --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<div
    class="flex h-full"
    x-data="{
        sidebarOpen: false,
        mounted: false,
        isDesktop: window.innerWidth >= 1024,
    }"
    x-init="$nextTick(() => { mounted = true })"
    @resize.window.debounce.100ms="isDesktop = window.innerWidth >= 1024"
    @keydown.escape.window="sidebarOpen = false"
>

    {{-- ━━━━ Overlay mobile (atrás do drawer) ━━━━ --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/40 z-40 lg:hidden"
        @click="sidebarOpen = false"
        style="display:none"
        aria-hidden="true"
    ></div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Sidebar — drawer em mobile, fixa em desktop                      --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <aside
        class="fixed inset-y-0 left-0 w-64 bg-slate-900 flex flex-col z-50"
        :class="{
            '-translate-x-full': !sidebarOpen && !isDesktop,
            'transition-transform duration-300 ease-in-out': mounted,
        }"
        aria-label="Menu de administração"
    >
        {{-- ━━ Logo + fechar (mobile) ━━ --}}
        <div class="px-5 py-4 border-b border-slate-700/60 flex items-center justify-between shrink-0">
            <a href="{{ route('admin.dashboard') }}" wire:navigate @click="sidebarOpen = false" class="group">
                <p class="font-script text-2xl text-rose-400 leading-none group-hover:text-rose-300 transition-colors">Verônica's</p>
                <p class="text-[10px] text-slate-500 tracking-widest uppercase font-sans mt-0.5">Fashion · Admin</p>
            </a>
            {{-- Botão fechar — apenas mobile --}}
            <button
                type="button"
                @click="sidebarOpen = false"
                class="lg:hidden p-1.5 rounded-lg text-slate-500 hover:text-slate-300 hover:bg-slate-800 transition-colors"
                aria-label="Fechar menu"
            >
                <flux:icon name="x-mark" class="w-5 h-5" />
            </button>
        </div>

        {{-- ━━ Navegação ━━ --}}
        <nav class="flex-1 px-3 py-3 overflow-y-auto space-y-0.5 scrollbar-thin" aria-label="Navegação principal">
            @php
                $navGroups = [
                    [
                        'label' => null,
                        'items' => [
                            [
                                'label'   => 'Painel',
                                'icon'    => 'squares-2x2',
                                'route'   => 'admin.dashboard',
                                'tooltip' => 'Visão geral do negócio',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Conteúdo',
                        'items' => [
                            [
                                'label'   => 'Produtos',
                                'icon'    => 'tag',
                                'route'   => 'admin.products.index',
                                'tooltip' => 'Gerenciar produtos do catálogo',
                            ],
                            [
                                'label'   => 'Banners',
                                'icon'    => 'photo',
                                'route'   => 'admin.banners.index',
                                'tooltip' => 'Slides do carrossel da home',
                            ],
                            [
                                'label'   => 'Coleções',
                                'icon'    => 'sparkles',
                                'route'   => 'admin.collections.index',
                                'tooltip' => 'Agrupamentos editoriais de produtos',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Taxonomias',
                        'items' => [
                            [
                                'label'   => 'Categorias',
                                'icon'    => 'folder',
                                'route'   => 'admin.categories.index',
                                'tooltip' => 'Tipos de produto (vestidos, conjuntos…)',
                            ],
                            [
                                'label'   => 'Tags',
                                'icon'    => 'hashtag',
                                'route'   => 'admin.tags.index',
                                'tooltip' => 'Rótulos especiais (Nova Coleção, Destaque…)',
                            ],
                            [
                                'label'   => 'Ocasiões',
                                'icon'    => 'calendar',
                                'route'   => 'admin.occasions.index',
                                'tooltip' => 'Filtro por momento (Festa, Casual…)',
                            ],
                            [
                                'label'   => 'Tamanhos',
                                'icon'    => 'adjustments-horizontal',
                                'route'   => 'admin.sizes.index',
                                'tooltip' => 'Opções de tamanho disponíveis',
                            ],
                            [
                                'label'   => 'Cores',
                                'icon'    => 'swatch',
                                'route'   => 'admin.colors.index',
                                'tooltip' => 'Paleta de cores com swatches',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Loja',
                        'items' => [
                            [
                                'label'   => 'Layout da Home',
                                'icon'    => 'home',
                                'route'   => 'admin.home-layout.index',
                                'tooltip' => 'Containers e seções da página inicial',
                            ],
                            [
                                'label'   => 'Menu do Site',
                                'icon'    => 'bars-3',
                                'route'   => 'admin.navigation.index',
                                'tooltip' => 'Itens e ordem do menu de navegação',
                            ],
                            [
                                'label'   => 'Usuários',
                                'icon'    => 'users',
                                'route'   => 'admin.users.index',
                                'tooltip' => 'Contas de acesso ao painel',
                            ],
                        ],
                    ],
                ];
            @endphp

            @foreach ($navGroups as $group)
                {{-- Label do grupo --}}
                @if ($group['label'])
                    <div class="pt-5 pb-1.5 px-3 flex items-center gap-2">
                        <span class="text-[11px] text-slate-500 uppercase tracking-widest font-sans font-medium">{{ $group['label'] }}</span>
                        <div class="flex-1 h-px bg-slate-700/50"></div>
                    </div>
                @endif

                {{-- Itens do grupo --}}
                @foreach ($group['items'] as $item)
                    @php $active = request()->routeIs($item['route'].'*'); @endphp
                    <div class="relative" x-data="{ tt: false }">
                        <a
                            href="{{ route($item['route']) }}"
                            wire:navigate
                            @click="sidebarOpen = false"
                            @mouseenter="tt = true"
                            @mouseleave="tt = false"
                            @focus="tt = true"
                            @blur="tt = false"
                            aria-current="{{ $active ? 'page' : 'false' }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-sans transition-all duration-200
                                {{ $active
                                    ? 'bg-rose-500/20 text-rose-300 font-medium'
                                    : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                        >
                            <flux:icon :name="$item['icon']" class="w-5 h-5 shrink-0 transition-transform duration-200" />
                            <span class="flex-1 truncate">{{ $item['label'] }}</span>
                            @if ($active)
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0" aria-hidden="true"></span>
                            @endif
                        </a>

                        {{-- Tooltip — apenas desktop, aparece à direita --}}
                        <div
                            x-show="tt"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 pointer-events-none hidden lg:block"
                            style="display:none"
                            role="tooltip"
                        >
                            <div class="relative bg-slate-700 text-white text-xs font-sans rounded-lg px-3 py-1.5 whitespace-nowrap shadow-xl border border-slate-600">
                                {{ $item['tooltip'] }}
                                {{-- Seta para a esquerda --}}
                                <div class="absolute right-full top-1/2 -translate-y-1/2 border-[5px] border-transparent border-r-slate-700" aria-hidden="true"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </nav>

        {{-- ━━ Footer — usuário + ações ━━ --}}
        <div class="px-4 py-3 border-t border-slate-700/60 shrink-0">
            @auth
                {{-- Avatar + nome --}}
                <div class="flex items-center gap-3 mb-2.5 px-1">
                    <div class="w-8 h-8 rounded-full bg-rose-500/20 border border-rose-500/30 flex items-center justify-center shrink-0">
                        <span class="text-rose-300 text-xs font-semibold font-sans">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-slate-200 text-sm font-sans truncate leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-slate-500 text-xs font-sans truncate leading-tight">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="space-y-0.5">
                    {{-- Limpar Cache --}}
                    <form method="POST" action="{{ route('admin.clear-cache') }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 text-slate-400 hover:text-amber-300 hover:bg-slate-800 rounded-lg text-xs font-sans transition-all duration-150"
                        >
                            <flux:icon name="arrow-path" class="w-4 h-4 shrink-0" />
                            Limpar Cache
                        </button>
                    </form>

                    {{-- Sair --}}
                    <form method="POST" action="/logout">
                        @csrf
                        <button
                            type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 text-slate-400 hover:text-rose-300 hover:bg-slate-800 rounded-lg text-xs font-sans transition-all duration-150"
                        >
                            <flux:icon name="arrow-right-start-on-rectangle" class="w-4 h-4 shrink-0" />
                            Sair da conta
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </aside>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Conteúdo principal                                               --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="flex-1 lg:ml-64 flex flex-col min-h-full min-w-0">

        {{-- Topbar --}}
        <header class="sticky top-0 z-30 bg-white border-b border-slate-200 h-14 flex items-center gap-3 px-4 lg:px-6 shrink-0">

            {{-- Hamburger — apenas mobile --}}
            <button
                type="button"
                @click="sidebarOpen = true"
                class="lg:hidden p-2 -ml-1 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors"
                aria-label="Abrir menu"
            >
                <flux:icon name="bars-3" class="w-5 h-5" />
            </button>

            {{-- Logo mini — apenas mobile, ao lado do hamburger --}}
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="lg:hidden font-script text-xl text-rose-500 leading-none">
                V's
            </a>

            {{-- Slot dinâmico da página --}}
            <div class="flex-1 min-w-0">
                @if (isset($header))
                    {{ $header }}
                @endif
            </div>

            {{-- Avatar do usuário — desktop --}}
            @auth
                <div class="hidden lg:flex items-center gap-2.5 pl-4 border-l border-slate-200">
                    <div class="w-7 h-7 rounded-full bg-rose-500/15 border border-rose-300/30 flex items-center justify-center">
                        <span class="text-rose-500 text-xs font-semibold font-sans">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <span class="text-slate-600 text-sm font-sans truncate max-w-35">{{ auth()->user()->name }}</span>
                </div>
            @endauth
        </header>

        {{-- Conteúdo da página --}}
        <main class="flex-1 p-4 sm:p-6">
            {{ $slot }}
        </main>
    </div>

</div>

@fluxScripts
@livewireScripts
</body>
</html>
