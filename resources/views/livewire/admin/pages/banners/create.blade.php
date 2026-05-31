<div class="space-y-6 max-w-2xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.banners.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Novo Banner</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                    <flux:label>Título *</flux:label>
                    <flux:input wire:model="title" placeholder="Ex: Nova Coleção Primavera" />
                    <flux:error name="title" />
                </flux:field>

                <flux:field class="sm:col-span-2">
                    <flux:label>Subtítulo</flux:label>
                    <flux:input wire:model="subtitle" placeholder="Ex: Looks feitos para você brilhar" />
                </flux:field>

                <flux:field class="sm:col-span-2">
                    <flux:label>Descrição</flux:label>
                    <flux:textarea wire:model="description" rows="3" placeholder="Texto de apoio do banner…" />
                </flux:field>

                <flux:field>
                    <flux:label>Texto do Botão (CTA)</flux:label>
                    <flux:input wire:model="cta_label" placeholder="Ex: Ver Coleção" />
                </flux:field>

                <flux:field>
                    <flux:label>Coleção</flux:label>
                    <flux:select wire:model="collection_id">
                        <option value="">Sem coleção</option>
                        @foreach ($collections as $col)
                            <option value="{{ $col->id }}">{{ $col->title }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="collection_id" />
                </flux:field>

                <flux:field>
                    <flux:label>Ordem</flux:label>
                    <flux:input type="number" wire:model="order" min="0" />
                </flux:field>

                <flux:field>
                    <flux:label>Ponto Focal da Imagem</flux:label>
                    <flux:select wire:model="image_position">
                        <option value="center">Centro (padrão)</option>
                        <option value="top">Topo</option>
                        <option value="bottom">Base</option>
                        <option value="left">Esquerda</option>
                        <option value="right">Direita</option>
                        <option value="top left">Topo Esquerdo</option>
                        <option value="top right">Topo Direito</option>
                        <option value="bottom left">Base Esquerda</option>
                        <option value="bottom right">Base Direita</option>
                    </flux:select>
                    <flux:description>Define qual parte da imagem fica visível quando cortada pela tela.</flux:description>
                </flux:field>
            </div>

            <div class="flex flex-col gap-3 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model="active" />
                    <span class="text-sm font-sans text-slate-700">Ativo</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model="hide_overlay" />
                    <span class="text-sm font-sans text-slate-700">Ocultar sobreposição de texto</span>
                </label>
                <p class="text-xs text-slate-400 font-sans -mt-1 ml-6">
                    Quando ativado, o título, subtítulo e botão ficam ocultos. A imagem do banner ocupa o slide inteiro e, se houver coleção vinculada, o slide inteiro vira um link clicável.
                </p>
            </div>
        </div>

        {{-- Imagem --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-3">
            <flux:heading size="lg" class="text-slate-700">Imagem</flux:heading>

            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="w-full max-w-sm h-40 object-cover rounded-xl border border-slate-200">
            @endif

            <input type="file"
                   wire:model="image"
                   accept="image/*"
                   class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100 transition-all cursor-pointer">
            <flux:error name="image" />
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Criar Banner</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.banners.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>
