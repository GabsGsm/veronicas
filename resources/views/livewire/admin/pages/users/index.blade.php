<div class="space-y-5">
    {{-- ━━━━ Header ━━━━ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <flux:heading size="xl" class="text-slate-800">Usuários</flux:heading>
        <div class="flex items-center gap-3">
            <flux:input
                wire:model.live.debounce.400ms="search"
                placeholder="Buscar usuário…"
                icon="magnifying-glass"
                class="w-56"
            />
            <flux:button variant="primary" href="{{ route('admin.users.create') }}" wire:navigate>
                + Novo Usuário
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
                        <th class="px-4 py-3">
                            <button wire:click="sort('email')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                E-mail
                                @if ($sortBy === 'email')
                                    <span class="text-rose-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Perfil</th>
                        <th class="px-4 py-3">
                            <button wire:click="sort('created_at')" class="flex items-center gap-1 text-xs font-medium text-slate-500 uppercase tracking-wide hover:text-slate-700">
                                Criado em
                                @if ($sortBy === 'created_at')
                                    <span class="text-rose-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-4 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors" wire:key="user-{{ $user->id }}">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-rose-500/20 flex items-center justify-center shrink-0">
                                        <span class="text-rose-400 text-xs font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" wire:navigate
                                       class="font-medium text-slate-800 hover:text-rose-500 transition-colors">
                                        {{ $user->name }}
                                        @if ($user->id === auth()->id())
                                            <span class="text-xs text-slate-400 font-normal">(você)</span>
                                        @endif
                                    </a>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-slate-500">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <flux:badge size="sm">{{ $user->role }}</flux:badge>
                            </td>
                            <td class="px-4 py-3 text-slate-400 text-xs">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button size="sm" variant="ghost" href="{{ route('admin.users.edit', $user->id) }}" wire:navigate>
                                        <flux:icon name="pencil" class="w-4 h-4" />
                                    </flux:button>

                                    @if ($user->id !== auth()->id())
                                        <flux:button size="sm" variant="ghost"
                                            x-data
                                            x-on:click="$flux.modal('delete-user-{{ $user->id }}').show()"
                                            class="text-red-500 hover:text-red-600">
                                            <flux:icon name="trash" class="w-4 h-4" />
                                        </flux:button>

                                        <flux:modal name="delete-user-{{ $user->id }}" class="max-w-sm">
                                            <flux:heading>Confirmar exclusão</flux:heading>
                                            <flux:text class="mt-2">
                                                Tem certeza que deseja remover <strong>{{ $user->name }}</strong>?
                                            </flux:text>
                                            <div class="flex gap-2 mt-5">
                                                <flux:button variant="danger"
                                                    wire:click="delete({{ $user->id }})"
                                                    x-on:click="$flux.modal('delete-user-{{ $user->id }}').close()">
                                                    Excluir
                                                </flux:button>
                                                <flux:button variant="ghost"
                                                    x-on:click="$flux.modal('delete-user-{{ $user->id }}').close()">
                                                    Cancelar
                                                </flux:button>
                                            </div>
                                        </flux:modal>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-sans">
                                Nenhum usuário encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
