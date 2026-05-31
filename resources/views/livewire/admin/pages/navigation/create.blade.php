<div class="space-y-6 max-w-2xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.navigation.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Novo Item de Menu</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- Label --}}
                <flux:field class="sm:col-span-2">
                    <flux:label>Label *</flux:label>
                    <flux:input wire:model="label" placeholder="Ex: Destaques" />
                    <flux:error name="label" />
                </flux:field>

                {{-- Icon picker --}}
                <div class="sm:col-span-2">
                    <p class="text-sm font-medium text-slate-700 mb-1.5 font-sans">Ícone</p>
                    <x-admin.icon-picker :icons="$availableIcons" :selected="$icon" property="icon" />
                    @error('icon') <p class="text-xs text-red-500 mt-1 font-sans">{{ $message }}</p> @enderror
                </div>

                {{-- Type --}}
                <flux:field>
                    <flux:label>Tipo *</flux:label>
                    <flux:select wire:model.live="type">
                        <option value="fixed">Página Fixa</option>
                        <option value="category">Categoria</option>
                        <option value="occasion">Ocasião</option>
                        <option value="tag">Tag</option>
                        <option value="collection">Coleção</option>
                    </flux:select>
                    <flux:error name="type" />
                </flux:field>

                {{-- Dynamic value selector --}}
                <flux:field>
                    <flux:label>Valor</flux:label>

                    @if ($type === 'fixed')
                        <flux:select wire:model="type_value">
                            <option value="">Selecione uma página…</option>
                            @foreach ($navigationPages as $routeName => $pageLabel)
                                <option value="{{ $routeName }}">{{ $pageLabel }}</option>
                            @endforeach
                        </flux:select>

                    @elseif ($type === 'category')
                        <flux:select wire:model="type_value">
                            <option value="">Selecione uma categoria…</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </flux:select>

                    @elseif ($type === 'occasion')
                        <flux:select wire:model="type_value">
                            <option value="">Selecione uma ocasião…</option>
                            @foreach ($occasions as $occasion)
                                <option value="{{ $occasion->slug }}">{{ $occasion->name }}</option>
                            @endforeach
                        </flux:select>

                    @elseif ($type === 'tag')
                        <flux:select wire:model="type_value">
                            <option value="">Selecione uma tag…</option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->slug }}">{{ $tag->name }}</option>
                            @endforeach
                        </flux:select>

                    @elseif ($type === 'collection')
                        <flux:select wire:model="type_value">
                            <option value="">Selecione uma coleção…</option>
                            @foreach ($collections as $collection)
                                <option value="{{ $collection->slug }}">{{ $collection->title }}</option>
                            @endforeach
                        </flux:select>
                    @endif

                    <flux:error name="type_value" />
                </flux:field>

                {{-- Order --}}
                <flux:field>
                    <flux:label>Ordem</flux:label>
                    <flux:input type="number" wire:model="order" min="0" />
                    <flux:error name="order" />
                </flux:field>

            </div>

            {{-- Active toggle --}}
            <label class="flex items-center gap-2 cursor-pointer">
                <flux:checkbox wire:model="active" />
                <span class="text-sm font-sans text-slate-700">Ativo</span>
            </label>
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Criar Item</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.navigation.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>
