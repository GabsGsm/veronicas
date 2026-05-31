<div class="space-y-5">
    {{-- ━━━━ Header ━━━━ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <flux:heading size="xl" class="text-slate-800">Produtos</flux:heading>
        <div class="flex items-center gap-3">
            <flux:input
                wire:model.live.debounce.400ms="search"
                placeholder="Buscar produto…"
                icon="magnifying-glass"
                class="w-56"
            />
            <flux:button variant="primary" href="{{ route('admin.products.create') }}" wire:navigate>
                + Novo Produto
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
                            <button wire:click="sort('name')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                Nome
                                @if ($sortBy === 'name')
                                    <span class="text-rose-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Categoria</th>
                        <th class="px-4 py-3">
                            <button wire:click="sort('price_cents')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                Preço
                                @if ($sortBy === 'price_cents')
                                    <span class="text-rose-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Status</th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Ordem</th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50 transition-colors" wire:key="product-{{ $product->id }}">
                            <td class="px-4 py-3">
                                @if ($product->primary_image)
                                    <img src="{{ Storage::disk('public')->url($product->primary_image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <flux:icon name="photo" class="w-5 h-5 text-slate-300" />
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-800">
                                <a href="{{ route('admin.products.edit', $product->id) }}" wire:navigate
                                   class="hover:text-rose-500 transition-colors">
                                    {{ $product->name }}
                                </a>
                                @if ($product->tag)
                                    <span class="ml-2 text-xs text-slate-400">{{ $product->tag }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-500">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-700">
                                {{ $product->formatted_price }}
                                @if ($product->isOnSale())
                                    <span class="ml-1 text-xs text-rose-400 line-through">{{ $product->formatted_original_price }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <flux:badge :variant="$product->active ? 'success' : 'zinc'" size="sm">
                                    {{ $product->active ? 'Ativo' : 'Inativo' }}
                                </flux:badge>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <button wire:click="moveUp({{ $product->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para cima">
                                        <flux:icon name="chevron-up" class="w-4 h-4" />
                                    </button>
                                    <input type="number"
                                           value="{{ $product->order }}"
                                           wire:change="updateOrder({{ $product->id }}, $event.target.value)"
                                           class="w-12 text-center text-xs border border-slate-200 rounded px-1 py-1 text-slate-700 focus:outline-none focus:ring-1 focus:ring-rose-300" />
                                    <button wire:click="moveDown({{ $product->id }})" class="p-1 text-slate-400 hover:text-slate-700 transition-colors" title="Mover para baixo">
                                        <flux:icon name="chevron-down" class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button size="sm" variant="ghost" href="{{ route('admin.products.edit', $product->id) }}" wire:navigate>
                                        <flux:icon name="pencil" class="w-4 h-4" />
                                    </flux:button>

                                    <flux:button size="sm" variant="ghost"
                                        x-data
                                        x-on:click="$flux.modal('delete-product-{{ $product->id }}').show()"
                                        class="text-red-500 hover:text-red-600">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:button>
                                </div>

                                <flux:modal name="delete-product-{{ $product->id }}" class="max-w-sm">
                                    <flux:heading>Confirmar exclusão</flux:heading>
                                    <flux:text class="mt-2">
                                        Tem certeza que deseja remover <strong>{{ $product->name }}</strong>? Esta ação não pode ser desfeita.
                                    </flux:text>
                                    <div class="flex gap-2 mt-5">
                                        <flux:button variant="danger"
                                            wire:click="delete({{ $product->id }})"
                                            x-on:click="$flux.modal('delete-product-{{ $product->id }}').close()">
                                            Excluir
                                        </flux:button>
                                        <flux:button variant="ghost"
                                            x-on:click="$flux.modal('delete-product-{{ $product->id }}').close()">
                                            Cancelar
                                        </flux:button>
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-sans">
                                Nenhum produto encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
