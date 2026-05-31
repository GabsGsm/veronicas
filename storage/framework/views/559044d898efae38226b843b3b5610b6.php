<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title'       => "Verônica's Fashion — Boutique Feminina Premium",
    'description' => "Descubra moda feminina premium na Verônica's Fashion. Peças exclusivas, elegantes e sofisticadas para todas as ocasiões.",
    'image'       => null,
    'url'         => null,
    'type'        => 'website',
    'jsonLd'      => null,
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
    'title'       => "Verônica's Fashion — Boutique Feminina Premium",
    'description' => "Descubra moda feminina premium na Verônica's Fashion. Peças exclusivas, elegantes e sofisticadas para todas as ocasiões.",
    'image'       => null,
    'url'         => null,
    'type'        => 'website',
    'jsonLd'      => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $canonicalUrl = $url ?? url()->current();
    $siteName     = "Verônica's Fashion";
    $ogImage      = $image ?? asset('web-app-manifest-512x512.png');
    $metaDesc     = Str::limit(strip_tags($description), 160);
    $ogDesc       = Str::limit(strip_tags($description), 200);

    // Suporta schema único (array associativo) ou lista de schemas
    $schemas = null;
    if ($jsonLd !== null) {
        $schemas = isset($jsonLd[0]) && is_array($jsonLd[0]) ? $jsonLd : [$jsonLd];
    }
?>

<meta name="description" content="<?php echo e($metaDesc); ?>">
<link rel="canonical" href="<?php echo e($canonicalUrl); ?>">


<meta property="og:site_name" content="<?php echo e($siteName); ?>">
<meta property="og:locale" content="pt_BR">
<meta property="og:type" content="<?php echo e($type); ?>">
<meta property="og:title" content="<?php echo e($title); ?>">
<meta property="og:description" content="<?php echo e($ogDesc); ?>">
<meta property="og:url" content="<?php echo e($canonicalUrl); ?>">
<meta property="og:image" content="<?php echo e($ogImage); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?php echo e($title); ?>">


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($title); ?>">
<meta name="twitter:description" content="<?php echo e($ogDesc); ?>">
<meta name="twitter:image" content="<?php echo e($ogImage); ?>">


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($schemas): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $schemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
<script type="application/ld+json">
<?php echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

</script>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/components/seo.blade.php ENDPATH**/ ?>