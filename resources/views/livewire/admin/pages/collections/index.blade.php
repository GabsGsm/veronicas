<div class="space-y-5">
    {{-- ━━━━ Header ━━━━ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <flux:heading size="xl" class="text-slate-800">Coleções</flux:heading>
        <div class="flex items-center gap-3">
            <flux:input
                wire:model.live.debounce.400ms="search"
                placeholder="Buscar coleção…"
                icon="magnifying-glass"
                class="w-56"
            />
            <flux:button variant="primary" href="{{ route('admin.collections.create') }}" wire:navigate>
                + Nova Coleção
            </flux:button>
        </div>
    </div>

    {{-- ━━━━ Table ━━━━ --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm font-sans">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-left">
                        <th class="px-4 py-3 w-16"></th>
                        <th class="px-4 py-3">
                            <button wire:click="sort('title')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                Título
                                @if ($sortBy === 'title')
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
                    @forelse ($collections as $collection)
                        <tr class="hover:bg-slate-50 transition-colors" wire:key="collection-{{ $collection->id }}">
                            <td class="px-4 py-3">
                                @if ($collection->cover_image)
                                    <img src="{{ $collection->cover_image_url }}"
                                         alt="{{ $collection->title }}"
                                         class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <flux:icon name="sparkles" class="w-5 h-5 text-slate-300" />
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-800">
                                <a href="{{ route('admin.collections.edit', $collection->id) }}" wire:navigate
                                   class="hover:text-rose-500 transition-colors">
                                    {{ $collection->title }}
                                </a>
                                @if ($collection->featured)
                                    <flux:badge variant="warning" size="sm" class="ml-2">Destaque</flux:badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-400 font-mono text-xs">{{ $collection->slug }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <button wire:click="moveUp({{ $collection->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para cima">
                                        <flux:icon name="chevron-up" class="w-4 h-4" />
                                    </button>
                                    <input type="number"
                                           value="{{ $collection->order }}"
                                           wire:change="updateOrder({{ $collection->id }}, $event.target.value)"
                                           class="w-12 text-center text-xs border border-slate-200 rounded px-1 py-1 text-slate-700 focus:outline-none focus:ring-1 focus:ring-rose-300" />
                                    <button wire:click="moveDown({{ $collection->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para baixo">
                                        <flux:icon name="chevron-down" class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <flux:badge :variant="$collection->active ? 'success' : 'zinc'" size="sm">
                                    {{ $collection->active ? 'Ativa' : 'Inativa' }}
                                </flux:badge>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button size="sm" variant="ghost" href="{{ route('admin.collections.edit', $collection->id) }}" wire:navigate>
                                        <flux:icon name="pencil" class="w-4 h-4" />
                                    </flux:button>

                                    <flux:button size="sm" variant="ghost"
                                        x-data
                                        x-on:click="$flux.modal('delete-collection-{{ $collection->id }}').show()"
                                        class="text-red-500 hover:text-red-600">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:button>
                                </div>

                                <flux:modal name="delete-collection-{{ $collection->id }}" class="max-w-sm">
                                    <flux:heading>Confirmar exclusão</flux:heading>
                                    <flux:text class="mt-2">
                                        Tem certeza que deseja remover <strong>{{ $collection->title }}</strong>?
                                        Os produtos e banners vinculados serão desassociados.
                                    </flux:text>
                                    <div class="flex gap-2 mt-5">
                                        <flux:button variant="danger"
                                            wire:click="delete({{ $collection->id }})"
                                            x-on:click="$flux.modal('delete-collection-{{ $collection->id }}').close()">
                                            Excluir
                                        </flux:button>
                                        <flux:button variant="ghost"
                                            x-on:click="$flux.modal('delete-collection-{{ $collection->id }}').close()">
                                            Cancelar
                                        </flux:button>
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-sans">
                                Nenhuma coleção encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($collections->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $collections->links() }}
            </div>
        @endif
    </div>
</div>
