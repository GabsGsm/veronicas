<div class="space-y-5">
    {{-- ━━━━ Header ━━━━ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <flux:heading size="xl" class="text-slate-800">Banners</flux:heading>
        <div class="flex items-center gap-3">
            <flux:input
                wire:model.live.debounce.400ms="search"
                placeholder="Buscar banner…"
                icon="magnifying-glass"
                class="w-56"
            />
            <flux:button variant="primary" href="{{ route('admin.banners.create') }}" wire:navigate>
                + Novo Banner
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
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Coleção</th>
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
                    @forelse ($banners as $banner)
                        <tr class="hover:bg-slate-50 transition-colors" wire:key="banner-{{ $banner->id }}">
                            <td class="px-4 py-3">
                                @if ($banner->image)
                                    <img src="{{ Storage::url($banner->image) }}"
                                         alt="{{ $banner->title }}"
                                         class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <flux:icon name="photo" class="w-5 h-5 text-slate-300" />
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-800">
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" wire:navigate
                                   class="hover:text-rose-500 transition-colors">
                                    {{ $banner->title }}
                                </a>
                                @if ($banner->subtitle)
                                    <p class="text-xs text-slate-400 truncate max-w-xs">{{ $banner->subtitle }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-500">{{ $banner->collection?->title ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-500">{{ $banner->order }}</td>
                            <td class="px-4 py-3">
                                <flux:badge :variant="$banner->active ? 'success' : 'zinc'" size="sm">
                                    {{ $banner->active ? 'Ativo' : 'Inativo' }}
                                </flux:badge>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button size="sm" variant="ghost" href="{{ route('admin.banners.edit', $banner->id) }}" wire:navigate>
                                        <flux:icon name="pencil" class="w-4 h-4" />
                                    </flux:button>

                                    <flux:button size="sm" variant="ghost"
                                        x-data
                                        x-on:click="$flux.modal('delete-banner-{{ $banner->id }}').show()"
                                        class="text-red-500 hover:text-red-600">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:button>
                                </div>

                                <flux:modal name="delete-banner-{{ $banner->id }}" class="max-w-sm">
                                    <flux:heading>Confirmar exclusão</flux:heading>
                                    <flux:text class="mt-2">
                                        Tem certeza que deseja remover <strong>{{ $banner->title }}</strong>?
                                    </flux:text>
                                    <div class="flex gap-2 mt-5">
                                        <flux:button variant="danger"
                                            wire:click="delete({{ $banner->id }})"
                                            x-on:click="$flux.modal('delete-banner-{{ $banner->id }}').close()">
                                            Excluir
                                        </flux:button>
                                        <flux:button variant="ghost"
                                            x-on:click="$flux.modal('delete-banner-{{ $banner->id }}').close()">
                                            Cancelar
                                        </flux:button>
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-sans">
                                Nenhum banner encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($banners->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $banners->links() }}
            </div>
        @endif
    </div>
</div>
