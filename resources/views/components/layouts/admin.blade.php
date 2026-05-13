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
    class="fixed top-4 right-4 z-50 flex flex-col gap-2 w-80"
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
            class="flex items-center gap-3 rounded-xl px-4 py-3 shadow-lg text-sm font-sans"
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

<div class="flex h-full">

    {{-- ━━━━ Sidebar ━━━━ --}}
    <aside class="fixed inset-y-0 left-0 w-64 bg-slate-900 flex flex-col z-20">
        {{-- Logo --}}
        <div class="px-6 py-5 border-b border-slate-700/60">
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="block text-center">
                <p class="font-script text-2xl text-rose-400 leading-none">Verônica's</p>
                <p class="text-[10px] text-slate-400 tracking-widest uppercase font-sans mt-0.5">Fashion · Admin</p>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
            @php
                $navItems = [
                    ['label' => 'Painel',    'icon' => 'squares-2x2',  'route' => 'admin.dashboard'],
                    ['label' => 'Produtos',  'icon' => 'tag',          'route' => 'admin.products.index'],
                    ['label' => 'Banners',   'icon' => 'photo',        'route' => 'admin.banners.index'],
                    ['label' => 'Coleções',  'icon' => 'sparkles',     'route' => 'admin.collections.index'],
                    ['label' => 'Usuários',  'icon' => 'users',        'route' => 'admin.users.index'],
                ];
            @endphp

            @foreach ($navItems as $item)
                @php $active = request()->routeIs($item['route'].'*'); @endphp
                <a
                    href="{{ route($item['route']) }}"
                    wire:navigate
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-sans transition-all duration-150
                        {{ $active
                            ? 'bg-rose-500/20 text-rose-300 font-medium'
                            : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}"
                >
                    <flux:icon :name="$item['icon']" class="w-5 h-5 flex-shrink-0" />
                    {{ $item['label'] }}
                </a>
            @endforeach

            {{-- Separador — futuros módulos --}}
            <div class="pt-4 pb-2">
                <p class="px-3 text-[10px] text-slate-500 uppercase tracking-widest font-sans">Em breve</p>
            </div>
            <span class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-sans text-slate-600 cursor-not-allowed select-none">
                <flux:icon name="archive-box" class="w-5 h-5 flex-shrink-0" />
                Estoque
            </span>
        </nav>

        {{-- Footer — usuário + logout --}}
        <div class="px-4 py-4 border-t border-slate-700/60">
            @auth
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 rounded-full bg-rose-500/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-rose-300 text-xs font-medium font-sans">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-slate-200 text-sm font-sans truncate">{{ auth()->user()->name }}</p>
                        <p class="text-slate-500 text-xs font-sans truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-slate-400 hover:text-rose-300 hover:bg-slate-800 rounded-lg text-sm font-sans transition-all">
                        <flux:icon name="arrow-right-start-on-rectangle" class="w-4 h-4" />
                        Sair
                    </button>
                </form>
            @endauth
        </div>
    </aside>

    {{-- ━━━━ Conteúdo principal ━━━━ --}}
    <div class="flex-1 ml-64 flex flex-col min-h-full">
        {{-- Topbar --}}
        <header class="sticky top-0 z-10 bg-white border-b border-slate-200 h-14 flex items-center px-6">
            @if (isset($header))
                {{ $header }}
            @endif
        </header>

        {{-- Page content --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

</div>

@fluxScripts
@livewireScripts
</body>
</html>
