<div class="space-y-6 max-w-3xl">
    <div class="flex items-center gap-4">
        <flux:button variant="ghost" size="sm" href="{{ route('admin.home-layout.index') }}" wire:navigate>
            <flux:icon name="arrow-left" class="w-4 h-4" />
        </flux:button>
        <flux:heading size="xl" class="text-slate-800">Editar Seção</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-5">

        {{-- ━━━━ Identificação ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide font-sans">Identificação</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                    <flux:label>Título da seção</flux:label>
                    <flux:input wire:model="title" placeholder="Ex: Destaques da Semana" />
                    <flux:error name="title" />
                </flux:field>
                <flux:field class="sm:col-span-2">
                    <flux:label>Descrição (subtítulo)</flux:label>
                    <flux:input wire:model="description" placeholder="Ex: Peças especialmente selecionadas para você" />
                </flux:field>
            </div>
        </div>

        {{-- ━━━━ Tipo de componente — agrupado por fonte ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-5">
            <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide font-sans">Layout *</h3>

            @php
                $typeIcons = [
                    'cards'               => 'squares-2x2',
                    'list'                => 'bars-3-bottom-left',
                    'editorial'           => 'newspaper',
                    'highlight_stack'     => 'rectangle-stack',
                    'highlight_list'      => 'view-columns',
                    'high_grid'           => 'table-cells',
                    'product_carousel'    => 'arrow-right',
                    'banner_carousel'     => 'photo',
                    'featured_collection' => 'sparkles',
                    'collection_grid'     => 'squares-2x2',
                    'collection_list'     => 'bars-3-bottom-left',
                ];
                $groups = [
                    ['label' => 'Produtos', 'types' => ['cards','list','editorial','highlight_stack','highlight_list','high_grid','product_carousel']],
                    ['label' => 'Banners',  'types' => ['banner_carousel']],
                    ['label' => 'Coleções', 'types' => ['featured_collection','collection_grid','collection_list']],
                ];
            @endphp

            @foreach ($groups as $group)
                <div>
                    <p class="text-xs font-semibold font-sans uppercase tracking-widest text-slate-400 mb-2">{{ $group['label'] }}</p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                        @foreach ($group['types'] as $value)
                            @if (isset($componentTypes[$value]))
                                <label class="flex flex-col items-center justify-center gap-1.5 p-3 rounded-xl border-2 cursor-pointer transition-all font-sans text-xs text-center
                                    {{ $componentType === $value
                                        ? 'border-primary bg-primary/5 text-primary font-semibold'
                                        : 'border-slate-200 text-slate-500 hover:border-primary/30 hover:bg-slate-50' }}">
                                    <input type="radio" wire:model.live="componentType" value="{{ $value }}" class="sr-only">
                                    <flux:icon :name="$typeIcons[$value] ?? 'square-2-stack'" class="w-5 h-5" />
                                    <span class="leading-tight">{{ $componentTypes[$value] }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

            @error('componentType') <p class="text-xs text-red-500 font-sans">{{ $message }}</p> @enderror
        </div>

        {{-- ━━━━ Filtros — condicional por fonte de dados ━━━━ --}}
        @if ($dataSource === 'products')
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
                <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide font-sans">Filtro de Produtos</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <flux:field>
                        <flux:label>Regra de filtro</flux:label>
                        <flux:select wire:model.live="filterType">
                            @foreach ($filterTypes as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>Ordenação</flux:label>
                        <flux:select wire:model="orderBy">
                            @foreach (config('veronica.home_order_by', []) as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </flux:select>
                    </flux:field>
                </div>
                @if (in_array($filterType, ['category', 'tag', 'occasion', 'collection']))
                    @php
                        $filterLabel = match($filterType) { 'category'=>'Categorias','tag'=>'Tags','occasion'=>'Ocasiões','collection'=>'Coleções',default=>'Valores' };
                        $filterItems = match($filterType) { 'category'=>$categories,'tag'=>$tags,'occasion'=>$occasions,'collection'=>$collections,default=>collect() };
                        $filterValueKey = match($filterType) { 'category'=>'slug','tag'=>'name','occasion'=>'name','collection'=>'slug',default=>'slug' };
                        $filterLabelKey = match($filterType) { 'collection'=>'title',default=>'name' };
                    @endphp
                    <div>
                        <p class="text-sm font-medium text-slate-700 mb-2 font-sans">{{ $filterLabel }} <span class="text-slate-400 text-xs">(vazio = todos)</span></p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 p-3 border border-slate-200 rounded-lg max-h-48 overflow-y-auto">
                            @foreach ($filterItems as $item)
                                <label class="flex items-center gap-2 cursor-pointer text-sm font-sans text-slate-700 hover:text-slate-900">
                                    <input type="checkbox" wire:model="filterValues" value="{{ $item->{$filterValueKey} }}" class="rounded border-slate-300 text-primary focus:ring-primary">
                                    {{ $item->{$filterLabelKey} }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        @elseif ($dataSource === 'banners')
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
                <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide font-sans">Filtro de Banners</h3>
                <flux:field>
                    <flux:label>Exibir</flux:label>
                    <flux:select wire:model.live="filterType">
                        <option value="all">Todos os banners ativos</option>
                        <option value="collection">Apenas de uma coleção</option>
                    </flux:select>
                </flux:field>
                @if ($filterType === 'collection')
                    <div>
                        <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Coleções</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 p-3 border border-slate-200 rounded-lg max-h-40 overflow-y-auto">
                            @foreach ($collections as $collection)
                                <label class="flex items-center gap-2 cursor-pointer text-sm font-sans text-slate-700 hover:text-slate-900">
                                    <input type="checkbox" wire:model="filterValues" value="{{ $collection->slug }}" class="rounded border-slate-300 text-primary focus:ring-primary">
                                    {{ $collection->title }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        @elseif ($dataSource === 'collections')
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
                <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide font-sans">Filtro de Coleções</h3>
                <flux:field>
                    <flux:label>Exibir</flux:label>
                    <flux:select wire:model.live="filterType">
                        <option value="all">Todas as coleções ativas</option>
                        <option value="featured">Apenas em destaque</option>
                        <option value="collection">Escolher específicas</option>
                    </flux:select>
                </flux:field>
                @if ($filterType === 'collection')
                    <div>
                        <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Coleções <span class="text-slate-400 text-xs">(selecione as que devem aparecer)</span></p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 p-3 border border-slate-200 rounded-lg max-h-48 overflow-y-auto">
                            @foreach ($collections as $collection)
                                <label class="flex items-center gap-2 cursor-pointer text-sm font-sans text-slate-700 hover:text-slate-900">
                                    <input type="checkbox" wire:model="filterValues" value="{{ $collection->slug }}" class="rounded border-slate-300 text-primary focus:ring-primary">
                                    {{ $collection->title }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif

        {{-- ━━━━ Quantidade e exibição ━━━━ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
            <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide font-sans">Opções de Exibição</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label>Quantidade de itens *</flux:label>
                    <flux:input type="number" wire:model="limit" min="1" max="24" />
                    <flux:error name="limit" />
                </flux:field>
                <flux:field>
                    <flux:label>Ordem</flux:label>
                    <flux:input type="number" wire:model="order" min="0" />
                    <flux:error name="order" />
                </flux:field>
            </div>
            <div class="space-y-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model="showTitle" />
                    <span class="text-sm font-sans text-slate-700">Exibir título da seção</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model.live="showViewAll" />
                    <span class="text-sm font-sans text-slate-700">Exibir botão "Ver todos"</span>
                </label>
                @if ($showViewAll)
                    <div class="ml-6 mt-3 space-y-3">
                        {{-- Texto + posição --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <flux:field>
                                <flux:label>Texto do botão</flux:label>
                                <flux:input wire:model="viewAllLabel" placeholder="Ver mais" />
                            </flux:field>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700 mb-2 font-sans">Posição do botão</p>
                            <div class="flex gap-3">
                                <label class="flex items-center gap-2 cursor-pointer text-sm font-sans {{ $viewAllPosition === 'inline' ? 'text-primary font-medium' : 'text-slate-600' }}">
                                    <input type="radio" wire:model="viewAllPosition" value="inline" class="text-primary focus:ring-primary">
                                    <span>Inline (ao lado do título)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer text-sm font-sans {{ $viewAllPosition === 'bottom' ? 'text-primary font-medium' : 'text-slate-600' }}">
                                    <input type="radio" wire:model="viewAllPosition" value="bottom" class="text-primary focus:ring-primary">
                                    <span>Embaixo (botão centralizado)</span>
                                </label>
                            </div>
                        </div>

                        {{-- Campo URL + assistente --}}
                        <div class="space-y-2">
                            <flux:field>
                                <flux:label>URL do botão (vazio = gerado automaticamente)</flux:label>
                                <div class="flex gap-2">
                                    <flux:input wire:model="viewAllUrl" placeholder="Deixe vazio para gerar automaticamente…" class="flex-1" />
                                    <button type="button" wire:click="$set('viewAllUrl', '')"
                                        class="shrink-0 text-xs font-sans text-slate-400 hover:text-slate-700 px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
                                        Limpar
                                    </button>
                                </div>
                                <flux:error name="viewAllUrl" />
                            </flux:field>

                            {{-- ━━ Assistente de URL ━━ --}}
                            <div
                                x-data="{
                                    sel: [],
                                    items: @js($this->urlBuilderItems()),
                                    filterSlugs: @js($this->filterValuesToBuilderSlugs()),
                                    busca: '{{ route('catalog.search') }}',
                                    base: '{{ url('') }}',
                                    get ft() { return '{{ $filterType }}'; },
                                    preview() {
                                        const v = this.sel;
                                        if (!v.length) return '';
                                        const ft = this.ft;
                                        if (ft === 'category') {
                                            return v.length === 1
                                                ? this.base + '/categoria/' + v[0]
                                                : this.busca + '?' + v.map(s => 'categorias[]=' + encodeURIComponent(s)).join('&');
                                        }
                                        if (ft === 'tag') {
                                            return v.length === 1
                                                ? this.base + '/tag/' + v[0]
                                                : this.busca + '?' + v.map(s => 'tags[]=' + encodeURIComponent(s)).join('&');
                                        }
                                        if (ft === 'occasion') {
                                            return v.length === 1
                                                ? this.base + '/ocasiao/' + v[0]
                                                : this.busca + '?' + v.map(s => 'ocasioes[]=' + encodeURIComponent(s)).join('&');
                                        }
                                        if (ft === 'collection') {
                                            return v.length === 1
                                                ? this.base + '/colecao/' + v[0]
                                                : this.busca + '?' + v.map(s => 'colecoes[]=' + encodeURIComponent(s)).join('&');
                                        }
                                        return this.busca;
                                    },
                                    apply() { $wire.applyUrlBuilder(this.preview()); },
                                    useFilter() { this.sel = [...this.filterSlugs]; }
                                }"
                                class="p-4 bg-slate-50 rounded-xl border border-dashed border-slate-200 space-y-3"
                            >
                                <p class="text-[11px] font-semibold font-sans uppercase tracking-widest text-slate-400">
                                    Assistente de URL
                                </p>

                                @if (in_array($filterType, ['all', 'featured', 'promotional', 'new']))
                                    {{-- Chips de rota + ordem com Alpine --}}
                                    <div
                                        x-data="{
                                            route: null,
                                            order: null,
                                            routes: [
                                                { label: '/busca',        url: '{{ route('catalog.search') }}',   supportsOrder: true },
                                                { label: '/destaques',    url: '{{ route('catalog.featured') }}', supportsOrder: false },
                                                { label: '/nova-colecao', url: '{{ route('catalog.new') }}',      supportsOrder: false },
                                                { label: '/promocoes',    url: '{{ route('catalog.sale') }}',     supportsOrder: false },
                                            ],
                                            orders: [
                                                { label: 'Mais recentes', value: 'newest' },
                                                { label: 'Mais antigos',  value: 'oldest' },
                                                { label: 'Menor preço',   value: 'price_asc' },
                                                { label: 'Maior preço',   value: 'price_desc' },
                                                { label: 'Destaque',      value: 'featured' },
                                            ],
                                            preview() {
                                                if (!this.route) return '';
                                                const base = this.route.url;
                                                if (!this.route.supportsOrder || !this.order || this.order === 'newest') return base;
                                                return base + '?ordem=' + this.order;
                                            },
                                            apply() { $wire.applyUrlBuilder(this.preview()); }
                                        }"
                                        class="space-y-3"
                                    >
                                        {{-- Rotas --}}
                                        <div>
                                            <p class="text-xs text-slate-500 font-sans mb-1.5">Rota de destino:</p>
                                            <div class="flex flex-wrap gap-2">
                                                <template x-for="r in routes" :key="r.label">
                                                    <button type="button" @click="route = r; if (!r.supportsOrder) order = null"
                                                        :class="route === r
                                                            ? 'border-primary bg-primary/5 text-primary font-medium'
                                                            : 'border-slate-200 bg-white text-slate-600 hover:border-primary/50 hover:text-primary'"
                                                        class="text-xs font-mono px-3 py-1.5 rounded-lg border transition-colors"
                                                        x-text="r.label">
                                                    </button>
                                                </template>
                                            </div>
                                        </div>

                                        {{-- Ordenação (só aparece para rotas que suportam ?ordem=) --}}
                                        <div x-show="route && route.supportsOrder" style="display:none">
                                            <p class="text-xs text-slate-500 font-sans mb-1.5">Ordenação <span class="text-slate-400">(padrão: mais recentes)</span>:</p>
                                            <div class="flex flex-wrap gap-2">
                                                <template x-for="o in orders" :key="o.value">
                                                    <button type="button" @click="order = o.value"
                                                        :class="order === o.value
                                                            ? 'border-primary bg-primary/5 text-primary font-medium'
                                                            : 'border-slate-200 bg-white text-slate-600 hover:border-primary/50 hover:text-primary'"
                                                        class="text-xs font-sans px-3 py-1.5 rounded-lg border transition-colors"
                                                        x-text="o.label">
                                                    </button>
                                                </template>
                                            </div>
                                        </div>

                                        {{-- Prévia --}}
                                        <div x-show="route" style="display:none" class="px-3 py-2 bg-white rounded-lg border border-slate-200">
                                            <p class="text-[10px] text-slate-400 font-sans uppercase tracking-wide mb-1">Prévia</p>
                                            <code class="text-xs text-primary break-all font-mono" x-text="preview()"></code>
                                        </div>

                                        {{-- Aplicar --}}
                                        <button type="button" @click="apply()"
                                            x-show="route" style="display:none"
                                            class="text-xs font-sans px-3 py-1.5 bg-primary text-white rounded-lg hover:bg-rose-600 transition-colors">
                                            Aplicar ao campo ↑
                                        </button>
                                    </div>

                                @elseif (in_array($filterType, ['category', 'tag', 'occasion', 'collection']))
                                    {{-- Checkboxes + prévia --}}
                                    <div>
                                        <p class="text-xs text-slate-500 font-sans mb-2">Marque os itens para montar a URL:</p>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-1.5 max-h-36 overflow-y-auto">
                                            <template x-for="item in items" :key="item.slug">
                                                <label class="flex items-center gap-2 text-sm font-sans cursor-pointer text-slate-700 hover:text-slate-900">
                                                    <input type="checkbox" x-model="sel" :value="item.slug"
                                                        class="rounded border-slate-300 text-primary focus:ring-primary">
                                                    <span x-text="item.name"></span>
                                                </label>
                                            </template>
                                        </div>
                                    </div>

                                    {{-- Prévia da URL --}}
                                    <div x-show="sel.length > 0" style="display:none"
                                        class="px-3 py-2 bg-white rounded-lg border border-slate-200">
                                        <p class="text-[10px] text-slate-400 font-sans uppercase tracking-wide mb-1">Prévia</p>
                                        <code class="text-xs text-primary break-all font-mono" x-text="preview()"></code>
                                    </div>

                                    {{-- Ações --}}
                                    <div class="flex flex-wrap gap-2">
                                        <button type="button" @click="apply()"
                                            x-show="sel.length > 0"
                                            style="display:none"
                                            class="text-xs font-sans px-3 py-1.5 bg-primary text-white rounded-lg hover:bg-rose-600 transition-colors">
                                            Aplicar ao campo ↑
                                        </button>
                                        <button type="button" @click="useFilter()"
                                            x-show="filterSlugs.length > 0"
                                            style="display:none"
                                            class="text-xs font-sans px-3 py-1.5 border border-slate-200 rounded-lg bg-white text-slate-600 hover:border-primary hover:text-primary transition-colors">
                                            Usar seleção do filtro
                                        </button>
                                    </div>
                                @else
                                    <p class="text-xs text-slate-400 font-sans italic">Selecione um tipo de filtro acima para ver as sugestões.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                <label class="flex items-center gap-2 cursor-pointer">
                    <flux:checkbox wire:model="active" />
                    <span class="text-sm font-sans text-slate-700">Seção ativa (visível na home)</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 pb-8">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Salvar</span>
                <span wire:loading>Salvando…</span>
            </flux:button>
            <flux:button variant="ghost" href="{{ route('admin.home-layout.index') }}" wire:navigate>Cancelar</flux:button>
        </div>
    </form>
</div>
