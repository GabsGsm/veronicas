<div class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
    {{-- Logo --}}
    <div class="text-center space-y-1">
        <p class="font-script text-3xl text-rose-500 leading-none">Verônica's</p>
        <p class="text-xs text-slate-500 tracking-widest uppercase font-sans">Fashion · Admin</p>
    </div>

    <form wire:submit="login" class="space-y-4">
        <flux:field>
            <flux:label>E-mail</flux:label>
            <flux:input
                type="email"
                wire:model="email"
                placeholder="admin@exemplo.com"
                autocomplete="email"
                autofocus
            />
            <flux:error name="email" />
        </flux:field>

        <flux:field>
            <flux:label>Senha</flux:label>
            <flux:input
                type="password"
                wire:model="password"
                placeholder="••••••••"
                autocomplete="current-password"
            />
            <flux:error name="password" />
        </flux:field>

        <div class="flex items-center gap-2">
            <flux:checkbox wire:model="remember" id="remember" />
            <label for="remember" class="text-sm text-slate-600 font-sans cursor-pointer">Lembrar de mim</label>
        </div>

        <flux:button type="submit" variant="primary" class="w-full" wire:loading.attr="disabled">
            <span wire:loading.remove>Entrar</span>
            <span wire:loading>Entrando…</span>
        </flux:button>
    </form>
</div>
