<div class="space-y-6 max-w-4xl">
    {{-- ━━━━ Page header ━━━━ --}}
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.products.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Editar Produto</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        {{-- ━━━━ Identificação ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:heading size="lg" class="text-slate-700">Identificação</flux:heading>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                    <flux:label>Nome *</flux:label>
                    <flux:input wire:model="name" />
                    <flux:error name="name" />
                </flux:field>

                {{-- Slug fixo — não muda ao editar nome para preservar URLs --}}
                <div class="flex flex-col gap-1.5">
                    <span class="text-sm font-medium text-slate-700">URL da página</span>
                    <div class="flex items-center gap-2 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg min-h-9.5">
                        <flux:icon name="link" class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                        <span class="text-xs text-slate-400 font-mono">/produto/</span>
                        <span class="text-sm text-slate-700 font-mono truncate">{{ $slug }}</span>
                        <flux:icon name="lock-closed" class="w-3.5 h-3.5 text-slate-400 ml-auto shrink-0" />
                    </div>
                    <p class="text-xs text-slate-400">URL permanente — não altera ao renomear</p>
                </div>

                <flux:field>
                    <flux:label>Categoria *</flux:label>
                    <flux:select wire:model="category_id">
                        <option value="">Selecione…</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="category_id" />
                </flux:field>

                <flux:field>
                    <flux:label>Coleção</flux:label>
                    <flux:select wire:model="collection_id">
                        <option value="">Sem coleção</option>
                        @foreach ($collections as $col)
                            <option value="{{ $col->id }}">{{ $col->title }}</option>
                        @endforeach
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:label>Tag</flux:label>
                    <flux:select wire:model="tag">
                        <option value="">Sem tag</option>
                        @foreach ($availableTags as $t)
                            <option value="{{ $t->name }}">{{ $t->name }}</option>
                        @endforeach
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:label>Ocasião</flux:label>
                    <flux:select wire:model="occasion">
                        <option value="">— Nenhuma —</option>
                        @foreach ($availableOccasions as $o)
                            <option value="{{ $o->name }}">{{ $o->name }}</option>
                        @endforeach
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:label>Ordem</flux:label>
                    <flux:input type="number" wire:model="order" min="0" />
                </flux:field>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model="active" />
                    <span class="text-sm font-sans text-slate-700">Ativo</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model="featured" />
                    <span class="text-sm font-sans text-slate-700">Destaque</span>
                </label>
            </div>
        </div>

        {{-- ━━━━ Preços ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:heading size="lg" class="text-slate-700">Preços</flux:heading>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label>Preço (R$) *</flux:label>
                    <flux:input type="number" step="0.01" min="0" wire:model="price" />
                    <flux:error name="price" />
                </flux:field>

                <flux:field>
                    <flux:label>Preço Promocional (R$)</flux:label>
                    <flux:input type="number" step="0.01" min="0" wire:model="promotional_price" placeholder="Deixe vazio para remover promoção" />
                    <flux:error name="promotional_price" />
                </flux:field>
            </div>
        </div>

        {{-- ━━━━ Descrição ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:heading size="lg" class="text-slate-700">Descrição do Produto</flux:heading>

            <flux:field>
                <flux:label>Descrição Completa</flux:label>
                <flux:description>Exibida na página do produto. Pode incluir detalhes de corte, uso e estilo.</flux:description>
                <flux:textarea wire:model="description" rows="5" />
            </flux:field>
        </div>

        {{-- ━━━━ Especificações ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:heading size="lg" class="text-slate-700">Especificações</flux:heading>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label>Tecido</flux:label>
                    <flux:input wire:model="fabric" />
                </flux:field>

                <flux:field>
                    <flux:label>Detalhes do Tecido</flux:label>
                    <flux:input wire:model="fabric_details" />
                </flux:field>
            </div>

            {{-- Tamanhos --}}
            <div>
                <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Tamanhos</p>
                <div class="flex flex-wrap gap-3">
                    @foreach ($availableSizes as $size)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <flux:checkbox wire:model="sizes" value="{{ $size->label }}" />
                            <span class="text-sm font-sans text-slate-700">{{ $size->label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            {{-- Cores --}}
            <div>
                <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Cores</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                    @foreach ($availableColors as $color)
                        <label class="flex items-center gap-2.5 cursor-pointer border border-slate-200 rounded-lg px-3 py-2 hover:bg-slate-50 transition-colors">
                            <flux:checkbox wire:model="colors" value="{{ $color->name }}" />
                            <span
                                class="w-4 h-4 rounded-full border border-slate-300 shrink-0"
                                style="background-color: {{ $color->hex_code }};"
                                aria-hidden="true"
                            ></span>
                            <span class="text-sm font-sans text-slate-700">{{ $color->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            {{-- Cuidados --}}
            <div>
                <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Cuidados</p>
                <div class="space-y-2 mb-3">
                    @foreach ($care as $i => $item)
                        <div class="flex items-center gap-2">
                            <span class="flex-1 text-sm text-slate-600 font-sans bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">{{ $item }}</span>
                            <button type="button" wire:click="removeCareItem({{ $i }})"
                                class="text-red-400 hover:text-red-600 transition-colors">
                                <flux:icon name="x-mark" class="w-4 h-4" />
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="flex gap-2">
                    <flux:input wire:model="newCareItem" placeholder="Ex: Lavar à mão" wire:keydown.enter.prevent="addCareItem" class="flex-1" />
                    <flux:button type="button" variant="ghost" wire:click="addCareItem">Adicionar</flux:button>
                </div>
            </div>
        </div>

        {{-- ━━━━ Imagens ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-5">
            <flux:heading size="lg" class="text-slate-700">Imagens</flux:heading>

            {{-- Imagem Principal --}}
            <div>
                <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Imagem Principal</p>

                @if ($existingPrimaryImage && !$newPrimaryImage)
                    <div class="relative inline-block mb-3 group">
                        <img src="{{ Storage::disk('public')->url($existingPrimaryImage) }}"
                             class="w-32 h-40 object-cover rounded-xl border border-slate-200">
                        <button type="button" wire:click="removeExistingPrimaryImage"
                            class="absolute top-1.5 right-1.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow">
                            <flux:icon name="x-mark" class="w-3 h-3" />
                        </button>
                    </div>
                @elseif ($newPrimaryImage)
                    <div class="mb-3">
                        <img src="{{ $newPrimaryImage->temporaryUrl() }}"
                             class="w-32 h-40 object-cover rounded-xl border border-slate-200">
                    </div>
                @endif

                <input type="file"
                       wire:model="newPrimaryImage"
                       accept="image/*"
                       class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100 transition-all cursor-pointer">
                <flux:error name="newPrimaryImage" />
            </div>

            {{-- Galeria --}}
            <div>
                <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Galeria de Imagens</p>

                @if (count($existingGallery) || count($newGalleryImages))
                    <div class="grid grid-cols-4 gap-3 mb-3">
                        @foreach ($existingGallery as $i => $img)
                            <div class="relative group">
                                <img src="{{ Storage::disk('public')->url($img) }}"
                                     class="w-full aspect-square object-cover rounded-xl border border-slate-200">
                                <button type="button" wire:click="removeExistingGalleryImage({{ $i }})"
                                    class="absolute top-1.5 right-1.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow">
                                    <flux:icon name="x-mark" class="w-3 h-3" />
                                </button>
                                <span class="absolute bottom-1.5 left-1.5 text-[10px] bg-black/40 text-white px-1.5 py-0.5 rounded font-sans">Salva</span>
                            </div>
                        @endforeach
                        @foreach ($newGalleryImages as $i => $img)
                            <div class="relative group">
                                <img src="{{ $img->temporaryUrl() }}"
                                     class="w-full aspect-square object-cover rounded-xl border border-dashed border-rose-300">
                                <button type="button" wire:click="removeNewGalleryImage({{ $i }})"
                                    class="absolute top-1.5 right-1.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow">
                                    <flux:icon name="x-mark" class="w-3 h-3" />
                                </button>
                                <span class="absolute bottom-1.5 left-1.5 text-[10px] bg-rose-500/80 text-white px-1.5 py-0.5 rounded font-sans">Nova</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <input type="file"
                       wire:model="newGalleryImages"
                       accept="image/*"
                       multiple
                       class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-slate-100 file:text-slate-600 hover:file:bg-slate-200 transition-all cursor-pointer">
                <p class="text-xs text-slate-400 mt-1 font-sans">Imagens salvas têm badge "Salva". Novas seleções têm badge "Nova". Máx. 2 MB cada.</p>
                <flux:error name="newGalleryImages.*" />
            </div>
        </div>

        {{-- ━━━━ SEO ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                <flux:icon name="magnifying-glass" class="w-4 h-4 text-slate-500 shrink-0" />
                <flux:heading size="lg" class="text-slate-700">SEO</flux:heading>
                <flux:badge variant="zinc" size="sm" class="ml-1">Busca orgânica</flux:badge>
            </div>
            <div class="p-6">
                <flux:field>
                    <flux:label>Meta Descrição</flux:label>
                    <flux:description>
                        Exibida pelo Google nos resultados de busca e ao compartilhar nas redes sociais.
                        Não aparece na loja. Ideal: entre 120 e 160 caracteres.
                    </flux:description>
                    <div x-data="{ count: {{ strlen($short_description ?? '') }} }">
                        <flux:textarea
                            wire:model="short_description"
                            rows="3"
                            x-on:input="count = $event.target.value.length"
                        />
                        <p class="text-xs mt-1.5 font-sans">
                            <span
                                :class="count > 160 ? 'text-red-500 font-medium' : count >= 120 ? 'text-amber-500' : 'text-slate-400'"
                                x-text="count"
                            ></span><span class="text-slate-400">/160 caracteres</span>
                        </p>
                    </div>
                </flux:field>
            </div>
        </div>

        {{-- ━━━━ Actions ━━━━ --}}
        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Salvar Alterações</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.products.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>

