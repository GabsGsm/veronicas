<div class="space-y-6 max-w-xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.home-layout.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Novo Container</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">

            <flux:field>
                <flux:label>Nome *</flux:label>
                <flux:input wire:model="name" placeholder="Ex: Principal, Promoções, Novidades…" />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>Tipo</flux:label>
                <flux:select wire:model="type">
                    <option value="full_width">Largura total</option>
                </flux:select>
                <flux:error name="type" />
            </flux:field>

            <flux:field>
                <flux:label>Ordem</flux:label>
                <flux:input type="number" wire:model="order" min="0" class="w-28" />
                <flux:error name="order" />
            </flux:field>

            <label class="flex items-center gap-2 cursor-pointer">
                <flux:checkbox wire:model="active" />
                <span class="text-sm font-sans text-slate-700">Ativo (visível na home)</span>
            </label>
        </div>

        <div class="flex items-center gap-3">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Criar Container</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.home-layout.index') }}" wire:navigate>Cancelar</flux:button>
        </div>
    </form>
</div>
