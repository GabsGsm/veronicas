<div class="space-y-5">
    {{-- ━━━━ Header ━━━━ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <flux:heading size="xl" class="text-slate-800">Cores</flux:heading>
        <div class="flex items-center gap-3">
            <flux:input
                wire:model.live.debounce.400ms="search"
                placeholder="Buscar cor…"
                icon="magnifying-glass"
                class="w-56"
            />
            <flux:button variant="primary" href="{{ route('admin.colors.create') }}" wire:navigate>
                + Nova Cor
            </flux:button>
        </div>
    </div>

    {{-- ━━━━ Table ━━━━ --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm font-sans">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-left">
                        <th class="px-4 py-3 w-14"></th>
                        <th class="px-4 py-3">
                            <button wire:click="sort('name')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                Nome
                                @if ($sortBy === 'name')
                                    <span class="text-rose-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Hex</th>
                        <th class="px-4 py-3">
                            <button wire:click="sort('order')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                Ordem
                                @if ($sortBy === 'order')
                                    <span class="text-rose-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Status</th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($colors as $color)
                        <tr class="hover:bg-slate-50 transition-colors" wire:key="color-{{ $color->id }}">
                            <td class="px-4 py-3">
                                <span class="block w-8 h-8 rounded-full border border-slate-200 shadow-sm"
                                      style="background-color: {{ $color->hex_code }}"></span>
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-800">
                                <a href="{{ route('admin.colors.edit', $color->id) }}" wire:navigate
                                   class="hover:text-rose-500 transition-colors">
                                    {{ $color->name }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <code class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded">{{ $color->hex_code }}</code>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <button wire:click="moveUp({{ $color->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para cima">
                                        <flux:icon name="chevron-up" class="w-4 h-4" />
                                    </button>
                                    <input type="number"
                                           value="{{ $color->order }}"
                                           wire:change="updateOrder({{ $color->id }}, $event.target.value)"
                                           class="w-12 text-center text-xs border border-slate-200 rounded px-1 py-1 text-slate-700 focus:outline-none focus:ring-1 focus:ring-rose-300" />
                                    <button wire:click="moveDown({{ $color->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para baixo">
                                        <flux:icon name="chevron-down" class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <flux:badge :variant="$color->active ? 'success' : 'zinc'" size="sm">
                                    {{ $color->active ? 'Ativo' : 'Inativo' }}
                                </flux:badge>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button size="sm" variant="ghost" href="{{ route('admin.colors.edit', $color->id) }}" wire:navigate>
                                        <flux:icon name="pencil" class="w-4 h-4" />
                                    </flux:button>

                                    <flux:button size="sm" variant="ghost"
                                        x-data
                                        x-on:click="$flux.modal('delete-color-{{ $color->id }}').show()"
                                        class="text-red-500 hover:text-red-600">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:button>
                                </div>

                                <flux:modal name="delete-color-{{ $color->id }}" class="max-w-sm">
                                    <flux:heading>Confirmar exclusão</flux:heading>
                                    <flux:text class="mt-2">
                                        Tem certeza que deseja remover a cor <strong>{{ $color->name }}</strong>?
                                    </flux:text>
                                    <div class="flex gap-2 mt-5">
                                        <flux:button variant="danger"
                                            wire:click="delete({{ $color->id }})"
                                            x-on:click="$flux.modal('delete-color-{{ $color->id }}').close()">
                                            Excluir
                                        </flux:button>
                                        <flux:button variant="ghost"
                                            x-on:click="$flux.modal('delete-color-{{ $color->id }}').close()">
                                            Cancelar
                                        </flux:button>
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-sans">
                                Nenhuma cor encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($colors->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $colors->links() }}
            </div>
        @endif
    </div>
</div>
