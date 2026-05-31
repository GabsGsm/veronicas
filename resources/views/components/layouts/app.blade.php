<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? "Verônica's Fashion - Catálogo" }}</title>

    @stack('meta')

    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Verônica's Fashion" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />

    @fonts

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="min-h-screen bg-background text-foreground antialiased">

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- SHELL: Sidebar fixa + área principal                       --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="min-h-screen">

        {{-- Sidebar (desktop + tablet, conforme React) --}}
        <livewire:shared.sidebar />

        {{-- Mobile header (apenas em telas <lg) --}}
        <livewire:shared.mobile-header />

        {{-- Main content --}}
        <main class="lg:ml-64 min-h-screen flex flex-col">
            <div class="flex-1 p-4 sm:p-6 lg:p-8 pt-20 lg:pt-8">
                {{ $slot }}
            </div>
        </main>

        {{-- Painel de filtros global (deslizante) --}}
        <livewire:shared.filter-panel />
    </div>

    @livewireScripts
</body>
</html>
