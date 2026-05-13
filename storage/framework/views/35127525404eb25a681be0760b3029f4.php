
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'productName',
    'productPrice',
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
    'productName',
    'productPrice',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $phone = config('veronica.whatsapp.number', '5511987654321');
    $staticMessage = "Olá! Tenho interesse no produto *{$productName}* ({$productPrice}) que vi no catálogo da Verônica's Fashion. 🌸";
    $staticUrl = 'https://wa.me/'.$phone.'?text='.rawurlencode($staticMessage);
?>

<a
    href="<?php echo e($staticUrl); ?>"
    x-data="{
        buildUrl(size, color) {
            let msg = <?php echo \Illuminate\Support\Js::from("Olá! Tenho interesse no produto *{$productName}* ({$productPrice})")->toHtml() ?>;
            if (size) msg += ' - Tamanho: ' + size;
            if (color) msg += ' - Cor: ' + color;
            msg += <?php echo \Illuminate\Support\Js::from(" que vi no catálogo da Verônica's Fashion. 🌸")->toHtml() ?>;
            return <?php echo \Illuminate\Support\Js::from('https://wa.me/'.$phone)->toHtml() ?> + '?text=' + encodeURIComponent(msg);
        }
    }"
    :href="buildUrl($parent.selectedSize ?? '', $parent.selectedColor ?? '')"
    target="_blank"
    rel="noopener noreferrer"
    class="w-full bg-[#25D366] hover:bg-[#20BD5C] text-white py-4 px-6 rounded-full font-sans transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-3 group active:scale-[0.98]"
>
    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'message-circle','class' => 'w-5 h-5 group-hover:scale-110 transition-transform']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'message-circle','class' => 'w-5 h-5 group-hover:scale-110 transition-transform']); ?>
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
    <span class="text-base">Consultar no WhatsApp</span>
</a>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/components/whatsapp-cta.blade.php ENDPATH**/ ?>