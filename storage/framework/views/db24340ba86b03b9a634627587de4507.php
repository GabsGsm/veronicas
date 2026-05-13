
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'story',
    'image',
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
    'story',
    'image',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="relative h-[400px] rounded-3xl overflow-hidden my-16 animate-fade-in-up">
    
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo e($image); ?>')">
        <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/85 to-transparent"></div>
    </div>

    
    <div class="relative h-full flex items-center px-8 md:px-16">
        <div class="max-w-2xl">
            <div class="inline-block mb-4">
                <span class="text-xs font-sans uppercase tracking-widest text-muted-foreground bg-white/80 px-4 py-2 rounded-full">
                    A História da Coleção
                </span>
            </div>
            <p class="font-sans text-base md:text-lg leading-relaxed text-foreground/90 bg-white/60 backdrop-blur-sm p-6 rounded-2xl">
                <?php echo e($story); ?>

            </p>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/components/editorial-banner.blade.php ENDPATH**/ ?>