<div class="space-y-5">
    {{-- ━━━━ Header ━━━━ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <flux:heading size="xl" class="text-slate-800">Ocasiões</flux:heading>
        <div class="flex items-center gap-3">
            <flux:input
                wire:model.live.debounce.400ms="search"
                placeholder="Buscar ocasião…"
                icon="magnifying-glass"
                class="w-56"
            />
            <flux:button variant="primary" href="{{ route('admin.occasions.create') }}" wire:navigate>
                + Nova Ocasião
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
                            <button wire:click="sort('name')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                Nome
                                @if ($sortBy === 'name')
                                    <span class="text-rose-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Slug</th>
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
                    @forelse ($occasions as $occasion)
                        <tr class="hover:bg-slate-50 transition-colors" wire:key="occasion-{{ $occasion->id }}">
                            <td class="px-4 py-3 font-medium text-slate-800">
                                <a href="{{ route('admin.occasions.edit', $occasion->id) }}" wire:navigate
                                   class="hover:text-rose-500 transition-colors">
                                    {{ $occasion->name }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <code class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded">{{ $occasion->slug }}</code>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <button wire:click="moveUp({{ $occasion->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para cima">
                                        <flux:icon name="chevron-up" class="w-4 h-4" />
                                    </button>
                                    <input type="number"
                                           value="{{ $occasion->order }}"
                                           wire:change="updateOrder({{ $occasion->id }}, $event.target.value)"
                                           class="w-12 text-center text-xs border border-slate-200 rounded px-1 py-1 text-slate-700 focus:outline-none focus:ring-1 focus:ring-rose-300" />
                                    <button wire:click="moveDown({{ $occasion->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para baixo">
                                        <flux:icon name="chevron-down" class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <flux:badge :variant="$occasion->active ? 'success' : 'zinc'" size="sm">
                                    {{ $occasion->active ? 'Ativo' : 'Inativo' }}
                                </flux:badge>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button size="sm" variant="ghost" href="{{ route('admin.occasions.edit', $occasion->id) }}" wire:navigate>
                                        <flux:icon name="pencil" class="w-4 h-4" />
                                    </flux:button>

                                    <flux:button size="sm" variant="ghost"
                                        x-data
                                        x-on:click="$flux.modal('delete-occasion-{{ $occasion->id }}').show()"
                                        class="text-red-500 hover:text-red-600">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:button>
                                </div>

                                <flux:modal name="delete-occasion-{{ $occasion->id }}" class="max-w-sm">
                                    <flux:heading>Confirmar exclusão</flux:heading>
                                    <flux:text class="mt-2">
                                        Tem certeza que deseja remover <strong>{{ $occasion->name }}</strong>?
                                    </flux:text>
                                    <div class="flex gap-2 mt-5">
                                        <flux:button variant="danger"
                                            wire:click="delete({{ $occasion->id }})"
                                            x-on:click="$flux.modal('delete-occasion-{{ $occasion->id }}').close()">
                                            Excluir
                                        </flux:button>
                                        <flux:button variant="ghost"
                                            x-on:click="$flux.modal('delete-occasion-{{ $occasion->id }}').close()">
                                            Cancelar
                                        </flux:button>
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-sans">
                                Nenhuma ocasião encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($occasions->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $occasions->links() }}
            </div>
        @endif
    </div>
</div>
