<div class="space-y-6 max-w-2xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.collections.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Nova Coleção</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        {{-- ━━━━ Identificação ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:heading size="lg" class="text-slate-700">Identificação</flux:heading>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                    <flux:label>Título *</flux:label>
                    <flux:input wire:model.blur="title" placeholder="Ex: Coleção Primavera 2026" />
                    <flux:error name="title" />
                </flux:field>

                <div class="sm:col-span-2 flex flex-col gap-1.5">
                    <span class="text-sm font-medium text-slate-700">URL da página</span>
                    <div class="flex items-center gap-2 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg min-h-9.5">
                        <flux:icon name="link" class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                        <span class="text-xs text-slate-400 font-mono">/colecao/</span>
                        <span class="text-sm text-slate-700 font-mono truncate">{{ $slug ?: '—' }}</span>
                        <flux:icon name="lock-closed" class="w-3.5 h-3.5 text-slate-400 ml-auto shrink-0" />
                    </div>
                    <p class="text-xs text-slate-400">Gerado automaticamente a partir do título</p>
                </div>

                <flux:field class="sm:col-span-2">
                    <flux:label>Subtítulo</flux:label>
                    <flux:input wire:model="subtitle" placeholder="Ex: Leveza e elegância para cada momento" />
                    <flux:description>Frase curta exibida abaixo do título no hero e na seção de encerramento.</flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Ordem</flux:label>
                    <flux:input type="number" wire:model="order" min="0" />
                </flux:field>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model="active" />
                    <span class="text-sm font-sans text-slate-700">Ativa</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model="featured" />
                    <span class="text-sm font-sans text-slate-700">Destaque</span>
                </label>
            </div>
        </div>

        {{-- ━━━━ Hero da Página ━━━━ --}}
        {{-- banner_image + description: aparecem no TOPO da página da coleção --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                <flux:icon name="photo" class="w-4 h-4 text-slate-500 shrink-0" />
                <flux:heading size="lg" class="text-slate-700">Hero da Página</flux:heading>
                <span class="ml-auto text-xs text-slate-400 font-sans whitespace-nowrap">Topo da página da coleção</span>
            </div>

            <div class="p-6 space-y-5">
                {{-- Imagem panorâmica do hero (banner_image) --}}
                <div>
                    <p class="text-sm font-medium text-slate-700 mb-1 font-sans">Imagem do Hero</p>
                    <p class="text-xs text-slate-400 font-sans mb-3">
                        Imagem de fundo panorâmica exibida no topo da página. Recomendado: formato landscape (16:9 ou mais largo).
                    </p>
                    @if ($bannerImage)
                        <img src="{{ $bannerImage->temporaryUrl() }}" class="w-full max-w-sm h-36 object-cover rounded-xl border border-slate-200 mb-3">
                    @endif
                    <input type="file"
                           wire:model="bannerImage"
                           accept="image/*"
                           class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100 transition-all cursor-pointer">
                    <flux:error name="bannerImage" />
                </div>

                {{-- Descrição exibida sobre o hero --}}
                <flux:field>
                    <flux:label>Texto de Apresentação</flux:label>
                    <flux:description>Exibido sobre a imagem do hero. Apresenta a coleção em uma ou duas frases.</flux:description>
                    <flux:textarea wire:model="description" rows="3" placeholder="Ex: Uma seleção de peças criadas para celebrar a feminilidade em cada detalhe." />
                </flux:field>
            </div>
        </div>

        {{-- ━━━━ Seção Editorial ━━━━ --}}
        {{-- story + cover_image: aparecem ABAIXO dos produtos --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                <flux:icon name="document-text" class="w-4 h-4 text-slate-500 shrink-0" />
                <flux:heading size="lg" class="text-slate-700">Seção Editorial</flux:heading>
                <span class="ml-auto text-xs text-slate-400 font-sans whitespace-nowrap">Abaixo dos produtos</span>
            </div>

            <div class="p-6 space-y-5">
                {{-- Texto editorial (story) --}}
                <flux:field>
                    <flux:label>Texto da História</flux:label>
                    <flux:description>Texto editorial exibido na seção abaixo dos produtos, ao lado da imagem.</flux:description>
                    <flux:textarea wire:model="story" rows="6" placeholder="Ex: Esta coleção nasceu da inspiração nas flores do campo e na delicadeza das manhãs de primavera…" />
                </flux:field>

                {{-- Imagem lateral retrato (cover_image) --}}
                <div>
                    <p class="text-sm font-medium text-slate-700 mb-1 font-sans">Imagem da Seção</p>
                    <p class="text-xs text-slate-400 font-sans mb-3">
                        Imagem exibida ao lado do texto editorial. Recomendado: formato retrato (3:4 ou 4:5).
                    </p>
                    @if ($coverImage)
                        <img src="{{ $coverImage->temporaryUrl() }}" class="w-32 h-40 object-cover rounded-xl border border-slate-200 mb-3">
                    @endif
                    <input type="file"
                           wire:model="coverImage"
                           accept="image/*"
                           class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-slate-100 file:text-slate-600 hover:file:bg-slate-200 transition-all cursor-pointer">
                    <flux:error name="coverImage" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Criar Coleção</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.collections.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>
