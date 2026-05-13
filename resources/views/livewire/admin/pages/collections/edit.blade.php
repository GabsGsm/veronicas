<div class="space-y-6 max-w-2xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.collections.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Editar Coleção</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">

        {{-- Identificação --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:heading size="lg" class="text-slate-700">Identificação</flux:heading>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                    <flux:label>Título *</flux:label>
                    <flux:input wire:model="title" />
                    <flux:error name="title" />
                </flux:field>

                <flux:field class="sm:col-span-2">
                    <flux:label>Slug *</flux:label>
                    <flux:input wire:model="slug" />
                    <flux:error name="slug" />
                </flux:field>

                <flux:field class="sm:col-span-2">
                    <flux:label>Subtítulo</flux:label>
                    <flux:input wire:model="subtitle" />
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

        {{-- Textos --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <flux:heading size="lg" class="text-slate-700">Textos</flux:heading>

            <flux:field>
                <flux:label>Descrição</flux:label>
                <flux:textarea wire:model="description" rows="3" />
            </flux:field>

            <flux:field>
                <flux:label>História</flux:label>
                <flux:textarea wire:model="story" rows="5" />
            </flux:field>
        </div>

        {{-- Imagens --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-5">
            <flux:heading size="lg" class="text-slate-700">Imagens</flux:heading>

            <div>
                <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Imagem de Capa</p>
                @if ($existingCoverImage && !$newCoverImage)
                    <div class="relative inline-block mb-2 group">
                        <img src="{{ Storage::url($existingCoverImage) }}"
                             class="w-32 h-40 object-cover rounded-xl border border-slate-200">
                        <button type="button" wire:click="removeExistingCoverImage"
                            class="absolute top-1.5 right-1.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow">
                            <flux:icon name="x-mark" class="w-3 h-3" />
                        </button>
                    </div>
                @elseif ($newCoverImage)
                    <img src="{{ $newCoverImage->temporaryUrl() }}" class="w-32 h-40 object-cover rounded-xl border border-dashed border-rose-300 mb-2">
                @endif
                <input type="file"
                       wire:model="newCoverImage"
                       accept="image/*"
                       class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100 transition-all cursor-pointer">
                <flux:error name="newCoverImage" />
            </div>

            <div>
                <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Imagem Banner</p>
                @if ($existingBannerImage && !$newBannerImage)
                    <div class="relative inline-block mb-2 group">
                        <img src="{{ Storage::url($existingBannerImage) }}"
                             class="w-full max-w-sm h-36 object-cover rounded-xl border border-slate-200">
                        <button type="button" wire:click="removeExistingBannerImage"
                            class="absolute top-1.5 right-1.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow">
                            <flux:icon name="x-mark" class="w-3 h-3" />
                        </button>
                    </div>
                @elseif ($newBannerImage)
                    <img src="{{ $newBannerImage->temporaryUrl() }}" class="w-full max-w-sm h-36 object-cover rounded-xl border border-dashed border-rose-300 mb-2">
                @endif
                <input type="file"
                       wire:model="newBannerImage"
                       accept="image/*"
                       class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-slate-100 file:text-slate-600 hover:file:bg-slate-200 transition-all cursor-pointer">
                <flux:error name="newBannerImage" />
            </div>
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Salvar Alterações</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.collections.index') }}" wire:navigate>
                Cancelar
            </flux:button>
        </div>

    </form>
</div>
