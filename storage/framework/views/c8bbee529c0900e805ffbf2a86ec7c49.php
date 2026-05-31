
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'collection',
    'productCount' => 0,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'collection',
    'productCount' => 0,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="relative h-[500px] md:h-[600px] rounded-3xl overflow-hidden bg-card shadow-premium mb-16">
    
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo e($collection->banner_image_url ?? ''); ?>')">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30"></div>
    </div>

    
    <div class="relative h-full flex flex-col justify-end p-8 md:p-16 text-white animate-fade-in-up">
        <p class="font-script text-3xl md:text-4xl mb-3 opacity-90">
            <?php echo e($collection->subtitle); ?>

        </p>

        <h1 class="font-serif text-4xl md:text-6xl mb-6 leading-tight tracking-tight">
            <?php echo e($collection->title); ?>

        </h1>

        <p class="font-sans text-lg md:text-xl mb-8 max-w-2xl leading-relaxed opacity-95">
            <?php echo e($collection->description); ?>

        </p>

        <div class="flex flex-wrap items-center gap-3 md:gap-6">
            <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'sparkles','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sparkles','class' => 'w-4 h-4']); ?>
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
                <span class="font-sans text-sm">Coleção Especial</span>
            </div>
            <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                <span class="font-sans text-sm"><?php echo e($productCount); ?> peças exclusivas</span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/components/collection-hero.blade.php ENDPATH**/ ?>