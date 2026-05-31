<div class="space-y-5">
    {{-- ━━━━ Header ━━━━ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <flux:heading size="xl" class="text-slate-800">Layout da Home</flux:heading>
            <p class="text-sm text-slate-500 font-sans mt-0.5">{{ $containers->count() }} container(s) configurado(s)</p>
        </div>
        <flux:button variant="primary" href="{{ route('admin.home-layout.container.create') }}" wire:navigate>
            + Novo Container
        </flux:button>
    </div>

    {{-- ━━━━ Lista de containers ━━━━ --}}
    @forelse ($containers as $container)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden" wire:key="container-{{ $container->id }}">

            {{-- Cabeçalho do container --}}
            <div class="flex items-center gap-3 px-5 py-4 border-b border-slate-100 bg-slate-50">
                {{-- Reordenar --}}
                <div class="flex flex-col gap-0.5">
                    <button wire:click="moveContainerUp({{ $container->id }})" class="p-0.5 text-slate-400 hover:text-slate-600 transition-colors" title="Mover para cima">
                        <flux:icon name="chevron-up" class="w-4 h-4" />
                    </button>
                    <button wire:click="moveContainerDown({{ $container->id }})" class="p-0.5 text-slate-400 hover:text-slate-600 transition-colors" title="Mover para baixo">
                        <flux:icon name="chevron-down" class="w-4 h-4" />
                    </button>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-medium text-slate-800 font-sans">{{ $container->name }}</span>
                        <flux:badge variant="zinc" size="sm">{{ $container->type === 'full_width' ? 'Largura total' : $container->type }}</flux:badge>
                        <span class="text-slate-400 text-xs font-sans">{{ $container->sections->count() }} seção(ões)</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <flux:badge :variant="$container->active ? 'success' : 'zinc'" size="sm">
                        {{ $container->active ? 'Ativo' : 'Inativo' }}
                    </flux:badge>
                    <button wire:click="toggleContainer({{ $container->id }})" class="text-xs text-slate-400 hover:text-slate-600 font-sans px-2 py-1 rounded hover:bg-slate-100 transition-colors">
                        {{ $container->active ? 'Desativar' : 'Ativar' }}
                    </button>
                    <flux:button size="sm" variant="ghost" href="{{ route('admin.home-layout.container.edit', $container->id) }}" wire:navigate>
                        <flux:icon name="pencil" class="w-4 h-4" />
                    </flux:button>
                    <flux:button size="sm" variant="ghost"
                        x-data
                        x-on:click="$flux.modal('delete-container-{{ $container->id }}').show()"
                        class="text-red-500 hover:text-red-600">
                        <flux:icon name="trash" class="w-4 h-4" />
                    </flux:button>
                </div>
            </div>

            {{-- Seções do container --}}
            <div class="divide-y divide-slate-100">
                <div class="px-5 py-2 flex items-center justify-between">
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wide font-sans">Seções</span>
                    <flux:button size="sm" variant="ghost" href="{{ route('admin.home-layout.section.create', $container->id) }}" wire:navigate>
                        + Adicionar seção
                    </flux:button>
                </div>

                @forelse ($container->sections as $section)
                    <div class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50 transition-colors" wire:key="section-{{ $section->id }}">
                        {{-- Reordenar seção --}}
                        <div class="flex flex-col gap-0.5">
                            <button wire:click="moveSectionUp({{ $section->id }})" class="p-0.5 text-slate-300 hover:text-slate-500 transition-colors">
                                <flux:icon name="chevron-up" class="w-3.5 h-3.5" />
                            </button>
                            <button wire:click="moveSectionDown({{ $section->id }})" class="p-0.5 text-slate-300 hover:text-slate-500 transition-colors">
                                <flux:icon name="chevron-down" class="w-3.5 h-3.5" />
                            </button>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-sans text-sm text-slate-700">{{ $section->title ?? '(sem título)' }}</span>
                                @php
                                    $typeLabels = config('veronica.home_component_types', []);
                                @endphp
                                <flux:badge variant="zinc" size="sm">{{ $typeLabels[$section->component_type] ?? $section->component_type }}</flux:badge>
                                @if ($section->filter_type && $section->filter_type !== 'all')
                                    <span class="text-xs text-slate-400 font-sans">
                                        {{ config('veronica.home_filter_types.'.$section->filter_type) }}
                                        @if (!empty($section->filter_values))
                                            : {{ implode(', ', array_slice($section->filter_values, 0, 3)) }}{{ count($section->filter_values) > 3 ? '…' : '' }}
                                        @endif
                                    </span>
                                @endif
                                <span class="text-xs text-slate-400 font-sans">{{ $section->limit }} itens</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <flux:badge :variant="$section->active ? 'success' : 'zinc'" size="sm">
                                {{ $section->active ? 'Ativa' : 'Inativa' }}
                            </flux:badge>
                            <button wire:click="toggleSection({{ $section->id }})" class="text-xs text-slate-400 hover:text-slate-600 font-sans px-2 py-1 rounded hover:bg-slate-100 transition-colors">
                                {{ $section->active ? 'Desativar' : 'Ativar' }}
                            </button>
                            <flux:button size="sm" variant="ghost" href="{{ route('admin.home-layout.section.edit', [$container->id, $section->id]) }}" wire:navigate>
                                <flux:icon name="pencil" class="w-4 h-4" />
                            </flux:button>
                            <flux:button size="sm" variant="ghost"
                                x-data
                                x-on:click="$flux.modal('delete-section-{{ $section->id }}').show()"
                                class="text-red-500 hover:text-red-600">
                                <flux:icon name="trash" class="w-4 h-4" />
                            </flux:button>
                        </div>

                        <flux:modal name="delete-section-{{ $section->id }}" class="max-w-sm">
                            <flux:heading>Confirmar exclusão</flux:heading>
                            <flux:text class="mt-2">Remover a seção <strong>{{ $section->title ?? '(sem título)' }}</strong>?</flux:text>
                            <div class="flex gap-2 mt-5">
                                <flux:button variant="danger" wire:click="deleteSection({{ $section->id }})" x-on:click="$flux.modal('delete-section-{{ $section->id }}').close()">Excluir</flux:button>
                                <flux:button variant="ghost" x-on:click="$flux.modal('delete-section-{{ $section->id }}').close()">Cancelar</flux:button>
                            </div>
                        </flux:modal>
                    </div>
                @empty
                    <div class="px-5 py-6 text-center text-slate-400 text-sm font-sans">
                        Nenhuma seção ainda. <a href="{{ route('admin.home-layout.section.create', $container->id) }}" wire:navigate class="text-primary hover:underline">Adicionar a primeira.</a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Modal de exclusão do container --}}
        <flux:modal name="delete-container-{{ $container->id }}" class="max-w-sm">
            <flux:heading>Confirmar exclusão</flux:heading>
            <flux:text class="mt-2">Remover o container <strong>{{ $container->name }}</strong> e todas as suas seções?</flux:text>
            <div class="flex gap-2 mt-5">
                <flux:button variant="danger" wire:click="deleteContainer({{ $container->id }})" x-on:click="$flux.modal('delete-container-{{ $container->id }}').close()">Excluir</flux:button>
                <flux:button variant="ghost" x-on:click="$flux.modal('delete-container-{{ $container->id }}').close()">Cancelar</flux:button>
            </div>
        </flux:modal>
    @empty
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 px-6 py-16 text-center">
            <flux:icon name="home" class="w-10 h-10 text-slate-300 mx-auto mb-3" />
            <p class="text-slate-500 font-sans">Nenhum container configurado ainda.</p>
            <flux:button variant="primary" href="{{ route('admin.home-layout.container.create') }}" wire:navigate class="mt-4">
                Criar primeiro container
            </flux:button>
        </div>
    @endforelse
</div>
