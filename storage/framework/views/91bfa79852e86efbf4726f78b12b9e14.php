
<aside class="hidden lg:flex w-64 h-screen bg-sidebar border-r border-sidebar-border flex-col fixed left-0 top-0 z-30">

    
    
    
    <div class="p-6 border-b border-sidebar-border">
        <a href="<?php echo e(route('home')); ?>" wire:navigate class="block text-center group">
            <h1 class="font-script text-3xl text-primary leading-none group-hover:opacity-80 transition-opacity">
                Verônica's
            </h1>
            <p class="text-xs text-muted-foreground mt-1 tracking-widest uppercase font-sans">
                Fashion
            </p>
        </a>
    </div>

    
    
    
    <nav class="flex-1 overflow-y-auto py-4 scrollbar-thin">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php
                $href = $item->url();
                $isActive = request()->url() === $href || request()->fullUrl() === $href;
            ?>

            <a
                href="<?php echo e($href); ?>"
                wire:navigate
                class="w-full flex items-center gap-3 px-6 py-3.5 transition-all duration-200 group
                    <?php echo e($isActive
                        ? 'bg-sidebar-accent text-sidebar-accent-foreground border-l-4 border-primary'
                        : 'text-sidebar-foreground hover:bg-sidebar-accent/50 border-l-4 border-transparent'); ?>"
            >
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->icon): ?>
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $item->icon,'class' => 'w-5 h-5 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->icon),'class' => 'w-5 h-5 shrink-0']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <span class="font-sans text-sm"><?php echo e($item->label); ?></span>
            </a>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </nav>

    
    
    
    <div class="p-4 border-t border-sidebar-border text-center">
        <p class="text-xs text-muted-foreground font-sans">© <?php echo e(date('Y')); ?> Verônica's Fashion</p>
        <p class="text-xs text-muted-foreground font-sans mt-1">Boutique Premium</p>
    </div>
</aside>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/livewire/shared/sidebar.blade.php ENDPATH**/ ?>