<div class="space-y-6 max-w-xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.users.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Editar Usuário</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:field>
                <flux:label>Nome *</flux:label>
                <flux:input wire:model="name" autocomplete="off" />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>E-mail *</flux:label>
                <flux:input type="email" wire:model="email" autocomplete="off" />
                <flux:error name="email" />
            </flux:field>
        </div>

        {{-- Alterar senha (opcional) --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <div>
                <flux:heading size="lg" class="text-slate-700">Alterar Senha</flux:heading>
                <p class="text-sm text-slate-400 font-sans mt-0.5">Deixe em branco para manter a senha atual.</p>
            </div>

            <flux:field>
                <flux:label>Nova Senha</flux:label>
                <flux:input type="password" wire:model="password" placeholder="Mínimo 8 caracteres" autocomplete="new-password" />
                <flux:error name="password" />
            </flux:field>

            <flux:field>
                <flux:label>Confirmar Nova Senha</flux:label>
                <flux:input type="password" wire:model="password_confirmation" placeholder="Repita a nova senha" autocomplete="new-password" />
                <flux:error name="password_confirmation" />
            </flux:field>
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Salvar Alterações</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.users.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>
