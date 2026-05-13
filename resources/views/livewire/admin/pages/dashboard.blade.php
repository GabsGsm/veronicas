{{-- ━━━━ Stats ━━━━ --}}
<div class="space-y-6">
    <flux:heading size="xl" class="text-slate-800">Painel</flux:heading>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Produtos --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
            <p class="text-xs font-sans text-slate-500 uppercase tracking-wide mb-1">Produtos</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['products'] }}</p>
            <p class="text-xs text-slate-400 mt-1 font-sans">{{ $stats['productsActive'] }} ativos · {{ $stats['productsSale'] }} em promoção</p>
        </div>

        {{-- Banners --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
            <p class="text-xs font-sans text-slate-500 uppercase tracking-wide mb-1">Banners</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['banners'] }}</p>
            <p class="text-xs text-slate-400 mt-1 font-sans">{{ $stats['bannersActive'] }} ativos</p>
        </div>

        {{-- Coleções --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
            <p class="text-xs font-sans text-slate-500 uppercase tracking-wide mb-1">Coleções</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['collections'] }}</p>
        </div>

        {{-- Usuários --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
            <p class="text-xs font-sans text-slate-500 uppercase tracking-wide mb-1">Usuários</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['users'] }}</p>
        </div>
    </div>

    {{-- ━━━━ Últimos produtos ━━━━ --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <flux:heading size="lg" class="text-slate-800">Últimos Produtos</flux:heading>
            <a href="{{ route('admin.products.index') }}" wire:navigate
               class="text-sm text-rose-500 hover:text-rose-600 font-sans font-medium">
                Ver todos →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm font-sans">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50 text-left">
                        <th class="px-6 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Nome</th>
                        <th class="px-6 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Categoria</th>
                        <th class="px-6 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Preço</th>
                        <th class="px-6 py-3 text-xs font-medium text-slate-500 uppercase tracking-wide">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($latestProducts as $product)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                <a href="{{ route('admin.products.edit', $product->id) }}" wire:navigate
                                   class="hover:text-rose-500 transition-colors">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ $product->formatted_price }}</td>
                            <td class="px-6 py-4">
                                <flux:badge :variant="$product->active ? 'success' : 'zinc'" size="sm">
                                    {{ $product->active ? 'Ativo' : 'Inativo' }}
                                </flux:badge>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400">Nenhum produto cadastrado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
