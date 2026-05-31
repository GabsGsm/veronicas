<div class="space-y-5">
    {{-- ━━━━ Header ━━━━ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <flux:heading size="xl" class="text-slate-800">Tamanhos</flux:heading>
        <div class="flex items-center gap-3">
            <flux:input
                wire:model.live.debounce.400ms="search"
                placeholder="Buscar tamanho…"
                icon="magnifying-glass"
                class="w-56"
            />
            <flux:button variant="primary" href="{{ route('admin.sizes.create') }}" wire:navigate>
                + Novo Tamanho
            </flux:button>
        </div>
    </div>

    {{-- ━━━━ Table ━━━━ --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm font-sans">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-left">
                        <th class="px-4 py-3">
                            <button wire:click="sort('label')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                Label
                                @if ($sortBy === 'label')
                                    <span class="text-rose-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
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
                    @forelse ($sizes as $size)
                        <tr class="hover:bg-slate-50 transition-colors" wire:key="size-{{ $size->id }}">
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.sizes.edit', $size->id) }}" wire:navigate
                                   class="hover:text-rose-500 transition-colors">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-rose-50 border border-rose-200 font-bold text-rose-700 text-sm font-sans tracking-widest">
                                        {{ $size->label }}
                                    </span>
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <button wire:click="moveUp({{ $size->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para cima">
                                        <flux:icon name="chevron-up" class="w-4 h-4" />
                                    </button>
                                    <input type="number"
                                           value="{{ $size->order }}"
                                           wire:change="updateOrder({{ $size->id }}, $event.target.value)"
                                           class="w-12 text-center text-xs border border-slate-200 rounded px-1 py-1 text-slate-700 focus:outline-none focus:ring-1 focus:ring-rose-300" />
                                    <button wire:click="moveDown({{ $size->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para baixo">
                                        <flux:icon name="chevron-down" class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <flux:badge :variant="$size->active ? 'success' : 'zinc'" size="sm">
                                    {{ $size->active ? 'Ativo' : 'Inativo' }}
                                </flux:badge>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button size="sm" variant="ghost" href="{{ route('admin.sizes.edit', $size->id) }}" wire:navigate>
                                        <flux:icon name="pencil" class="w-4 h-4" />
                                    </flux:button>

                                    <flux:button size="sm" variant="ghost"
                                        x-data
                                        x-on:click="$flux.modal('delete-size-{{ $size->id }}').show()"
                                        class="text-red-500 hover:text-red-600">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:button>
                                </div>

                                <flux:modal name="delete-size-{{ $size->id }}" class="max-w-sm">
                                    <flux:heading>Confirmar exclusão</flux:heading>
                                    <flux:text class="mt-2">
                                        Tem certeza que deseja remover o tamanho <strong>{{ $size->label }}</strong>?
                                    </flux:text>
                                    <div class="flex gap-2 mt-5">
                                        <flux:button variant="danger"
                                            wire:click="delete({{ $size->id }})"
                                            x-on:click="$flux.modal('delete-size-{{ $size->id }}').close()">
                                            Excluir
                                        </flux:button>
                                        <flux:button variant="ghost"
                                            x-on:click="$flux.modal('delete-size-{{ $size->id }}').close()">
                                            Cancelar
                                        </flux:button>
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-sans">
                                Nenhum tamanho encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($sizes->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $sizes->links() }}
            </div>
        @endif
    </div>
</div>
