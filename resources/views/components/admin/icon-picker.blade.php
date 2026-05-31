{{--
    <x-admin.icon-picker :icons="$availableIcons" :selected="$icon" property="icon" />

    Seletor visual de ícones com busca Alpine.js.
    Props:
      - icons    : array<string>  — lista de nomes de ícones disponíveis
      - selected : string         — nome do ícone atualmente selecionado
      - property : string         — nome da propriedade Livewire a atualizar
--}}
@props([
    'icons'    => [],
    'selected' => '',
    'property' => 'icon',
])

<div
    x-data="{
        open: false,
        search: '',
        selected: '{{ $selected }}',
        icons: @js($icons),
        get filtered() {
            const q = this.search.toLowerCase().trim();
            return q ? this.icons.filter(n => n.includes(q)) : this.icons;
        },
        select(name) {
            this.selected = name;
            $wire.set('{{ $property }}', name);
            this.open = false;
            this.search = '';
        },
    }"
    x-init="$watch('open', v => { if (v) $nextTick(() => $refs.iconSearch?.focus()) })"
    class="relative"
    x-on:click.outside="open = false"
    x-on:keydown.escape.window="open = false"
>
    {{-- ━━━━ Trigger ━━━━ --}}
    <button
        type="button"
        @click="open = !open"
        :aria-expanded="open"
        class="w-full flex items-center gap-3 px-3 py-2.5 border rounded-lg bg-white transition-colors text-left font-sans text-sm"
        :class="open ? 'border-rose-400 ring-2 ring-rose-100' : 'border-slate-200 hover:border-rose-300'"
    >
        {{-- Preview do ícone selecionado --}}
        <div class="relative w-8 h-8 shrink-0 rounded-md bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
            @foreach ($icons as $n)
                <span
                    x-show="selected === '{{ $n }}'"
                    class="absolute inset-0 flex items-center justify-center text-rose-500"
                    style="display:none"
                >
                    <x-icon name="{{ $n }}" class="w-5 h-5" />
                </span>
            @endforeach
            <span x-show="!selected" class="text-slate-300 text-lg font-bold" style="display:none">?</span>
        </div>

        {{-- Nome --}}
        <span class="flex-1 truncate" :class="selected ? 'text-slate-700' : 'text-slate-400'" x-text="selected || 'Escolher ícone…'"></span>

        {{-- Chevron --}}
        <svg class="w-4 h-4 text-slate-400 shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
        </svg>
    </button>

    {{-- ━━━━ Dropdown ━━━━ --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        class="absolute left-0 right-0 top-full mt-1.5 z-50 bg-white border border-slate-200 rounded-xl shadow-xl origin-top"
        style="display:none"
    >
        {{-- Busca --}}
        <div class="p-2.5 border-b border-slate-100">
            <div class="relative">
                <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                </svg>
                <input
                    x-model="search"
                    x-ref="iconSearch"
                    type="search"
                    placeholder="Buscar ícone…"
                    class="w-full pl-8 pr-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-300 focus:bg-white transition-colors"
                    autocomplete="off"
                />
            </div>
        </div>

        {{-- Grid de ícones --}}
        <div class="p-2.5 max-h-60 overflow-y-auto">
            <div class="grid grid-cols-6 gap-1">
                @foreach ($icons as $n)
                    <button
                        type="button"
                        x-show="filtered.includes('{{ $n }}')"
                        @click="select('{{ $n }}')"
                        :class="selected === '{{ $n }}'
                            ? 'bg-rose-50 border-rose-300 text-rose-500'
                            : 'border-transparent text-slate-400 hover:bg-slate-50 hover:border-slate-200 hover:text-slate-600'"
                        class="flex flex-col items-center gap-1 p-2 rounded-lg border transition-colors group"
                        :title="'{{ $n }}'"
                    >
                        <x-icon name="{{ $n }}" class="w-5 h-5 shrink-0" />
                        <span class="text-[10px] font-sans leading-none truncate w-full text-center">{{ $n }}</span>
                    </button>
                @endforeach
            </div>

            {{-- Empty state --}}
            <p
                x-show="filtered.length === 0"
                class="text-center text-sm text-slate-400 py-6 font-sans"
                style="display:none"
            >
                Nenhum ícone encontrado
            </p>
        </div>

        {{-- Rodapé: limpar seleção --}}
        <div class="px-3 py-2 border-t border-slate-100 flex items-center justify-between">
            <span class="text-xs text-slate-400 font-sans" x-text="filtered.length + ' ícones'"></span>
            <button
                type="button"
                x-show="selected"
                @click="select('')"
                class="text-xs text-slate-400 hover:text-rose-500 font-sans transition-colors"
                style="display:none"
            >
                Limpar
            </button>
        </div>
    </div>
</div>
