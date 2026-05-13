<div class="space-y-6 max-w-xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.users.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Novo Usuário</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:field>
                <flux:label>Nome *</flux:label>
                <flux:input wire:model="name" placeholder="Ex: Verônica Silva" autocomplete="off" />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>E-mail *</flux:label>
                <flux:input type="email" wire:model="email" placeholder="admin@veronica.com" autocomplete="off" />
                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label>Senha *</flux:label>
                <flux:input type="password" wire:model="password" placeholder="Mínimo 8 caracteres" autocomplete="new-password" />
                <flux:error name="password" />
            </flux:field>

            <flux:field>
                <flux:label>Confirmar Senha *</flux:label>
                <flux:input type="password" wire:model="password_confirmation" placeholder="Repita a senha" autocomplete="new-password" />
                <flux:error name="password_confirmation" />
            </flux:field>
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Criar Usuário</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.users.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>
