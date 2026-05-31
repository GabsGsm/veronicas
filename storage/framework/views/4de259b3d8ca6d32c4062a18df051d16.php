<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isOpen): ?>
        <div class="fixed inset-0 z-50">
            
            <div
                class="absolute inset-0 bg-black/20 backdrop-blur-sm animate-fade-in"
                wire:click="close"
            ></div>

            
            <aside class="absolute right-0 top-0 h-screen w-80 max-w-[90vw] bg-card shadow-2xl overflow-y-auto animate-slide-in-right scrollbar-thin">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-serif text-2xl">Filtros</h2>
                        <button
                            type="button"
                            wire:click="close"
                            class="p-2 hover:bg-muted rounded-full transition-colors"
                            aria-label="Fechar filtros"
                        >
                            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-5 h-5']); ?>
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
                        </button>
                    </div>

                    
                    <div class="mb-6">
                        <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
                            Tamanho
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filterOptions['sizes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <button
                                    type="button"
                                    wire:click="toggleSize('<?php echo e($size); ?>')"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'px-4 py-2 border rounded-lg font-sans text-sm transition-colors',
                                        'border-primary bg-primary text-white' => in_array($size, $selectedSizes, true),
                                        'border-border hover:border-primary hover:text-primary' => ! in_array($size, $selectedSizes, true),
                                    ]); ?>"
                                >
                                    <?php echo e($size); ?>

                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="mb-6">
                        <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
                            Cor
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filterOptions['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php $colorName = $color['name']; ?>
                                <button
                                    type="button"
                                    wire:click="toggleColor('<?php echo e($colorName); ?>')"
                                    title="<?php echo e($colorName); ?>"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'flex items-center gap-1.5 px-2 py-1.5 border rounded-lg transition-colors font-sans text-xs',
                                        'border-primary bg-primary/10 text-primary' => in_array($colorName, $selectedColors, true),
                                        'border-border hover:border-primary hover:bg-primary/5' => ! in_array($colorName, $selectedColors, true),
                                    ]); ?>"
                                >
                                    <span class="w-4 h-4 rounded-full border border-border/50 shrink-0" style="background-color: <?php echo e($color['hex_code']); ?>;"></span>
                                    <?php echo e($colorName); ?>

                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="mb-6">
                        <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
                            Ocasião
                        </h3>
                        <div class="space-y-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filterOptions['occasions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors">
                                    <input
                                        type="checkbox"
                                        wire:click="toggleOccasion('<?php echo e($occasion); ?>')"
                                        <?php if(in_array($occasion, $selectedOccasions, true)): echo 'checked'; endif; ?>
                                        class="w-4 h-4 rounded border-border text-primary focus:ring-primary"
                                    >
                                    <span class="font-sans text-sm"><?php echo e($occasion); ?></span>
                                </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="mb-6">
                        <h3 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-3">
                            Faixa de Preço
                        </h3>
                        <div class="space-y-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filterOptions['priceRanges']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors">
                                    <input
                                        type="radio"
                                        name="price"
                                        value="<?php echo e($range['label']); ?>"
                                        wire:model.live="selectedPriceRange"
                                        class="w-4 h-4 border-border text-primary focus:ring-primary"
                                    >
                                    <span class="font-sans text-sm"><?php echo e($range['label']); ?></span>
                                </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="flex gap-3 mt-8">
                        <button
                            type="button"
                            wire:click="clearAll"
                            class="flex-1 bg-muted hover:bg-muted/80 text-foreground py-3 rounded-lg font-sans text-sm transition-all"
                        >
                            Limpar
                        </button>
                        <button
                            type="button"
                            wire:click="apply"
                            class="flex-1 bg-primary hover:bg-rose-600 text-white py-3 rounded-lg font-sans text-sm transition-all"
                        >
                            Aplicar
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/livewire/shared/filter-panel.blade.php ENDPATH**/ ?>