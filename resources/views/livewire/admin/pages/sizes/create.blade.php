<div class="space-y-6 max-w-2xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.sizes.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Novo Tamanho</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label>Label *</flux:label>
                    <flux:input wire:model="label" placeholder="Ex: PP, P, M, G, GG, XGG" />
                    <flux:description>Etiqueta exibida no catálogo (máx. 20 caracteres).</flux:description>
                    <flux:error name="label" />
                </flux:field>

                <flux:field>
                    <flux:label>Ordem</flux:label>
                    <flux:input type="number" wire:model="order" min="0" />
                    <flux:error name="order" />
                </flux:field>
            </div>

            @if ($label)
                <div class="pt-2">
                    <p class="text-xs font-sans text-slate-500 mb-2">Pré-visualização:</p>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-rose-50 border border-rose-200 font-bold text-rose-700 text-sm font-sans tracking-widest">
                        {{ $label }}
                    </span>
                </div>
            @endif

            <label class="flex items-center gap-2 cursor-pointer">
                <flux:checkbox wire:model="active" />
                <span class="text-sm font-sans text-slate-700">Ativo</span>
            </label>
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Criar Tamanho</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.sizes.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>
