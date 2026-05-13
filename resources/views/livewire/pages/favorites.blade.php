<div>
    @if ($favoriteProducts->isEmpty())
        <x-page-header
            decorative="Seus favoritos"
            title="Lista de Desejos"
            subtitle="Salve suas peças preferidas para não perder de vista"
        />

        <div class="text-center py-20 bg-card rounded-2xl">
            <x-icon name="heart" class="w-16 h-16 text-muted-foreground/30 mx-auto mb-4" />
            <p class="font-serif text-2xl text-muted-foreground mb-2">Nenhum favorito ainda</p>
            <p class="text-muted-foreground font-sans">
                Clique no coração nas peças que você ama para salvá-las aqui
            </p>
            <a
                href="{{ route('home') }}"
                wire:navigate
                class="inline-block mt-6 bg-primary hover:bg-rose-600 text-white px-6 py-3 rounded-full font-sans text-sm transition-all"
            >
                Explorar Catálogo
            </a>
        </div>
    @else
        <x-page-header
            decorative="Seus favoritos"
            title="Lista de Desejos"
            :subtitle="$favoriteProducts->count().' '.($favoriteProducts->count() === 1 ? 'peça salva' : 'peças salvas')"
        />

        <x-product-grid :products="$favoriteProducts" :favorites="$favorites" />
    @endif
</div>
