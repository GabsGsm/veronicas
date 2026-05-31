<?php $__env->startPush('meta'); ?>
<?php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $collectionUrl   = route('collection.show', $collection->slug);
    $collectionImage = $collection->cover_image_url
        ? url($collection->cover_image_url)
        : ($collection->banner_image_url ? url($collection->banner_image_url) : asset('web-app-manifest-512x512.png'));

    $metaTitle = $collection->title . " | Verônica's Fashion";
    $metaDesc  = $collection->description
        ?? $collection->subtitle
        ?? "Explore a coleção {$collection->title} da Verônica's Fashion. Peças exclusivas de moda feminina premium.";

    $collectionSchema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'CollectionPage',
        'name'        => $collection->title,
        'description' => strip_tags($collection->description ?? $collection->subtitle ?? ''),
        'url'         => $collectionUrl,
        'image'       => $collectionImage,
        'provider'    => [
            '@type' => 'Organization',
            'name'  => "Verônica's Fashion",
            'url'   => route('home'),
        ],
    ];

    $breadcrumbSchema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Início', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $collection->title, 'item' => $collectionUrl],
        ],
    ];
?>
<?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => $metaTitle,'description' => $metaDesc,'image' => $collectionImage,'url' => $collectionUrl,'type' => 'website','jsonLd' => [$collectionSchema, $breadcrumbSchema]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($metaTitle),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($metaDesc),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collectionImage),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collectionUrl),'type' => 'website','json-ld' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([$collectionSchema, $breadcrumbSchema])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42da61123f891e63201d7be28f403427)): ?>
<?php $attributes = $__attributesOriginal42da61123f891e63201d7be28f403427; ?>
<?php unset($__attributesOriginal42da61123f891e63201d7be28f403427); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42da61123f891e63201d7be28f403427)): ?>
<?php $component = $__componentOriginal42da61123f891e63201d7be28f403427; ?>
<?php unset($__componentOriginal42da61123f891e63201d7be28f403427); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<div class="max-w-7xl mx-auto">
    
    <?php if (isset($component)) { $__componentOriginal98178ee5c2506acd1a1bd6aac3021ac1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98178ee5c2506acd1a1bd6aac3021ac1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.collection-hero','data' => ['collection' => $collection,'productCount' => $collection->products->count()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('collection-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['collection' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collection),'product-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collection->products->count())]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal98178ee5c2506acd1a1bd6aac3021ac1)): ?>
<?php $attributes = $__attributesOriginal98178ee5c2506acd1a1bd6aac3021ac1; ?>
<?php unset($__attributesOriginal98178ee5c2506acd1a1bd6aac3021ac1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal98178ee5c2506acd1a1bd6aac3021ac1)): ?>
<?php $component = $__componentOriginal98178ee5c2506acd1a1bd6aac3021ac1; ?>
<?php unset($__componentOriginal98178ee5c2506acd1a1bd6aac3021ac1); ?>
<?php endif; ?>

    
    <div class="mb-16">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($collection->products->isEmpty()): ?>
            <div class="text-center py-20 bg-card rounded-2xl">
                <p class="text-muted-foreground font-sans text-lg">Esta coleção ainda não possui peças cadastradas.</p>
            </div>
        <?php else: ?>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 auto-rows-fr gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $collection->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $pattern = $index % 5;
                        $cls = match ($pattern) {
                            0 => 'sm:col-span-2 lg:col-span-2 lg:row-span-2',
                            3 => 'sm:col-span-2 lg:col-span-2',
                            default => '',
                        };
                    ?>

                    <div class="<?php echo e($cls); ?> animate-fade-in-up" style="animation-delay: <?php echo e($index * 80); ?>ms">
                        <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $product,'isFavorite' => in_array($product->id, $favorites, true)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product),'is-favorite' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(in_array($product->id, $favorites, true))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($collection->story): ?>
        <?php if (isset($component)) { $__componentOriginalf4a88f1b2c30d386ef9b8dde6be5ef51 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4a88f1b2c30d386ef9b8dde6be5ef51 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.editorial-banner','data' => ['story' => $collection->story,'image' => $collection->cover_image_url]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('editorial-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['story' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collection->story),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collection->cover_image_url)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4a88f1b2c30d386ef9b8dde6be5ef51)): ?>
<?php $attributes = $__attributesOriginalf4a88f1b2c30d386ef9b8dde6be5ef51; ?>
<?php unset($__attributesOriginalf4a88f1b2c30d386ef9b8dde6be5ef51); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4a88f1b2c30d386ef9b8dde6be5ef51)): ?>
<?php $component = $__componentOriginalf4a88f1b2c30d386ef9b8dde6be5ef51; ?>
<?php unset($__componentOriginalf4a88f1b2c30d386ef9b8dde6be5ef51); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="text-center py-16 bg-editorial-rose rounded-3xl mb-12">
        <p class="font-script text-3xl md:text-4xl text-primary mb-4">
            <?php echo e($collection->subtitle); ?>

        </p>
        <p class="font-sans text-muted-foreground max-w-2xl mx-auto px-6">
            Uma coleção criada com dedicação e atenção aos detalhes.
            Cada peça conta uma história de elegância e sofisticação.
        </p>
    </div>
</div>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/livewire/pages/collection-show.blade.php ENDPATH**/ ?>