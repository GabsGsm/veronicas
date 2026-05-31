<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50" style="--color-accent:#be123c;--color-accent-foreground:#fff;--color-accent-content:#9f1239;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(isset($title) ? $title.' | ' : ''); ?>Admin — Verônica's Fashion</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="h-full" x-data>


<div
    x-data="{ toasts: [] }"
    @toast.window="toasts.push({ ...($event.detail[0] ?? $event.detail), id: Date.now() }); setTimeout(() => toasts.shift(), 4000)"
    class="fixed top-4 right-4 z-[60] flex flex-col gap-2 w-80 pointer-events-none"
    aria-live="polite"
>
    <template x-for="t in toasts" :key="t.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="flex items-center gap-3 rounded-xl px-4 py-3 shadow-lg text-sm font-sans pointer-events-auto"
            :class="{
                'bg-emerald-500 text-white': t.type === 'success',
                'bg-red-500 text-white': t.type === 'error' || t.type === 'danger',
                'bg-amber-400 text-slate-900': t.type === 'warning',
                'bg-slate-800 text-white': !t.type || t.type === 'info',
            }"
        >
            <span x-text="t.message" class="flex-1"></span>
        </div>
    </template>
</div>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('cache_cleared')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { type: 'success', message: '✓ Config, cache e views limpos com sucesso!' }
            }));
        }, 150);
    });
</script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>




<div
    class="flex h-full"
    x-data="{
        sidebarOpen: false,
        mounted: false,
        isDesktop: window.innerWidth >= 1024,
    }"
    x-init="$nextTick(() => { mounted = true })"
    @resize.window.debounce.100ms="isDesktop = window.innerWidth >= 1024"
    @keydown.escape.window="sidebarOpen = false"
>

    
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/40 z-40 lg:hidden"
        @click="sidebarOpen = false"
        style="display:none"
        aria-hidden="true"
    ></div>

    
    
    
    <aside
        class="fixed inset-y-0 left-0 w-64 bg-slate-900 flex flex-col z-50"
        :class="{
            '-translate-x-full': !sidebarOpen && !isDesktop,
            'transition-transform duration-300 ease-in-out': mounted,
        }"
        aria-label="Menu de administração"
    >
        
        <div class="px-5 py-4 border-b border-slate-700/60 flex items-center justify-between shrink-0">
            <a href="<?php echo e(route('admin.dashboard')); ?>" wire:navigate @click="sidebarOpen = false" class="group">
                <p class="font-script text-2xl text-rose-400 leading-none group-hover:text-rose-300 transition-colors">Verônica's</p>
                <p class="text-[10px] text-slate-500 tracking-widest uppercase font-sans mt-0.5">Fashion · Admin</p>
            </a>
            
            <button
                type="button"
                @click="sidebarOpen = false"
                class="lg:hidden p-1.5 rounded-lg text-slate-500 hover:text-slate-300 hover:bg-slate-800 transition-colors"
                aria-label="Fechar menu"
            >
                <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => 'x-mark','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x-mark','class' => 'w-5 h-5']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
            </button>
        </div>

        
        <nav class="flex-1 px-3 py-3 overflow-y-auto space-y-0.5 scrollbar-thin" aria-label="Navegação principal">
            <?php
                $navGroups = [
                    [
                        'label' => null,
                        'items' => [
                            [
                                'label'   => 'Painel',
                                'icon'    => 'squares-2x2',
                                'route'   => 'admin.dashboard',
                                'tooltip' => 'Visão geral do negócio',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Conteúdo',
                        'items' => [
                            [
                                'label'   => 'Produtos',
                                'icon'    => 'tag',
                                'route'   => 'admin.products.index',
                                'tooltip' => 'Gerenciar produtos do catálogo',
                            ],
                            [
                                'label'   => 'Banners',
                                'icon'    => 'photo',
                                'route'   => 'admin.banners.index',
                                'tooltip' => 'Slides do carrossel da home',
                            ],
                            [
                                'label'   => 'Coleções',
                                'icon'    => 'sparkles',
                                'route'   => 'admin.collections.index',
                                'tooltip' => 'Agrupamentos editoriais de produtos',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Taxonomias',
                        'items' => [
                            [
                                'label'   => 'Categorias',
                                'icon'    => 'folder',
                                'route'   => 'admin.categories.index',
                                'tooltip' => 'Tipos de produto (vestidos, conjuntos…)',
                            ],
                            [
                                'label'   => 'Tags',
                                'icon'    => 'hashtag',
                                'route'   => 'admin.tags.index',
                                'tooltip' => 'Rótulos especiais (Nova Coleção, Destaque…)',
                            ],
                            [
                                'label'   => 'Ocasiões',
                                'icon'    => 'calendar',
                                'route'   => 'admin.occasions.index',
                                'tooltip' => 'Filtro por momento (Festa, Casual…)',
                            ],
                            [
                                'label'   => 'Tamanhos',
                                'icon'    => 'adjustments-horizontal',
                                'route'   => 'admin.sizes.index',
                                'tooltip' => 'Opções de tamanho disponíveis',
                            ],
                            [
                                'label'   => 'Cores',
                                'icon'    => 'swatch',
                                'route'   => 'admin.colors.index',
                                'tooltip' => 'Paleta de cores com swatches',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Loja',
                        'items' => [
                            [
                                'label'   => 'Layout da Home',
                                'icon'    => 'home',
                                'route'   => 'admin.home-layout.index',
                                'tooltip' => 'Containers e seções da página inicial',
                            ],
                            [
                                'label'   => 'Menu do Site',
                                'icon'    => 'bars-3',
                                'route'   => 'admin.navigation.index',
                                'tooltip' => 'Itens e ordem do menu de navegação',
                            ],
                            [
                                'label'   => 'Usuários',
                                'icon'    => 'users',
                                'route'   => 'admin.users.index',
                                'tooltip' => 'Contas de acesso ao painel',
                            ],
                        ],
                    ],
                ];
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $navGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($group['label']): ?>
                    <div class="pt-5 pb-1.5 px-3 flex items-center gap-2">
                        <span class="text-[11px] text-slate-500 uppercase tracking-widest font-sans font-medium"><?php echo e($group['label']); ?></span>
                        <div class="flex-1 h-px bg-slate-700/50"></div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $group['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php $active = request()->routeIs($item['route'].'*'); ?>
                    <div class="relative" x-data="{ tt: false }">
                        <a
                            href="<?php echo e(route($item['route'])); ?>"
                            wire:navigate
                            @click="sidebarOpen = false"
                            @mouseenter="tt = true"
                            @mouseleave="tt = false"
                            @focus="tt = true"
                            @blur="tt = false"
                            aria-current="<?php echo e($active ? 'page' : 'false'); ?>"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-sans transition-all duration-200
                                <?php echo e($active
                                    ? 'bg-rose-500/20 text-rose-300 font-medium'
                                    : 'text-slate-400 hover:bg-slate-800 hover:text-white'); ?>"
                        >
                            <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => $item['icon'],'class' => 'w-5 h-5 shrink-0 transition-transform duration-200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['icon']),'class' => 'w-5 h-5 shrink-0 transition-transform duration-200']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
                            <span class="flex-1 truncate"><?php echo e($item['label']); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($active): ?>
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0" aria-hidden="true"></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </a>

                        
                        <div
                            x-show="tt"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 pointer-events-none hidden lg:block"
                            style="display:none"
                            role="tooltip"
                        >
                            <div class="relative bg-slate-700 text-white text-xs font-sans rounded-lg px-3 py-1.5 whitespace-nowrap shadow-xl border border-slate-600">
                                <?php echo e($item['tooltip']); ?>

                                
                                <div class="absolute right-full top-1/2 -translate-y-1/2 border-[5px] border-transparent border-r-slate-700" aria-hidden="true"></div>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </nav>

        
        <div class="px-4 py-3 border-t border-slate-700/60 shrink-0">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                
                <div class="flex items-center gap-3 mb-2.5 px-1">
                    <div class="w-8 h-8 rounded-full bg-rose-500/20 border border-rose-500/30 flex items-center justify-center shrink-0">
                        <span class="text-rose-300 text-xs font-semibold font-sans"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-slate-200 text-sm font-sans truncate leading-tight"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-slate-500 text-xs font-sans truncate leading-tight"><?php echo e(auth()->user()->email); ?></p>
                    </div>
                </div>

                <div class="space-y-0.5">
                    
                    <form method="POST" action="<?php echo e(route('admin.clear-cache')); ?>">
                        <?php echo csrf_field(); ?>
                        <button
                            type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 text-slate-400 hover:text-amber-300 hover:bg-slate-800 rounded-lg text-xs font-sans transition-all duration-150"
                        >
                            <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => 'arrow-path','class' => 'w-4 h-4 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-path','class' => 'w-4 h-4 shrink-0']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
                            Limpar Cache
                        </button>
                    </form>

                    
                    <form method="POST" action="/logout">
                        <?php echo csrf_field(); ?>
                        <button
                            type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 text-slate-400 hover:text-rose-300 hover:bg-slate-800 rounded-lg text-xs font-sans transition-all duration-150"
                        >
                            <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => 'arrow-right-start-on-rectangle','class' => 'w-4 h-4 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right-start-on-rectangle','class' => 'w-4 h-4 shrink-0']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
                            Sair da conta
                        </button>
                    </form>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </aside>

    
    
    
    <div class="flex-1 lg:ml-64 flex flex-col min-h-full min-w-0">

        
        <header class="sticky top-0 z-30 bg-white border-b border-slate-200 h-14 flex items-center gap-3 px-4 lg:px-6 shrink-0">

            
            <button
                type="button"
                @click="sidebarOpen = true"
                class="lg:hidden p-2 -ml-1 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors"
                aria-label="Abrir menu"
            >
                <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => 'bars-3','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bars-3','class' => 'w-5 h-5']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
            </button>

            
            <a href="<?php echo e(route('admin.dashboard')); ?>" wire:navigate class="lg:hidden font-script text-xl text-rose-500 leading-none">
                V's
            </a>

            
            <div class="flex-1 min-w-0">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header)): ?>
                    <?php echo e($header); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="hidden lg:flex items-center gap-2.5 pl-4 border-l border-slate-200">
                    <div class="w-7 h-7 rounded-full bg-rose-500/15 border border-rose-300/30 flex items-center justify-center">
                        <span class="text-rose-500 text-xs font-semibold font-sans"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></span>
                    </div>
                    <span class="text-slate-600 text-sm font-sans truncate max-w-35"><?php echo e(auth()->user()->name); ?></span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </header>

        
        <main class="flex-1 p-4 sm:p-6">
            <?php echo e($slot); ?>

        </main>
    </div>

</div>

<?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/components/layouts/admin.blade.php ENDPATH**/ ?>