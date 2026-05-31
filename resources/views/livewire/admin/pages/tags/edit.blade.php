<div class="space-y-6 max-w-2xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.tags.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Editar Tag</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                    <flux:label>Nome *</flux:label>
                    <flux:input wire:model="name" />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>Ordem</flux:label>
                    <flux:input type="number" wire:model="order" min="0" />
                    <flux:error name="order" />
                </flux:field>
            </div>

            <label class="flex items-center gap-2 cursor-pointer">
                <flux:checkbox wire:model="active" />
                <span class="text-sm font-sans text-slate-700">Ativo</span>
            </label>
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Salvar Alterações</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.tags.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>
