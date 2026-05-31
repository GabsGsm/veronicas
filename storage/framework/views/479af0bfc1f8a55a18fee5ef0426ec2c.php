<?php $__env->startPush('meta'); ?>
<?php
    $organizationSchema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'ClothingStore',
        'name'            => "Verônica's Fashion",
        'description'     => "Boutique feminina especializada em moda premium, com peças exclusivas e elegantes para todas as ocasiões.",
        'url'             => route('home'),
        'logo'            => asset('web-app-manifest-512x512.png'),
        'image'           => asset('web-app-manifest-512x512.png'),
        'telephone'       => config('veronica.contact.phone'),
        'address'         => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => config('veronica.contact.address'),
            'addressCountry'  => 'BR',
        ],
        'contactPoint' => [
            '@type'       => 'ContactPoint',
            'contactType' => 'customer service',
            'telephone'   => config('veronica.contact.phone'),
            'availableLanguage' => 'Portuguese',
        ],
        'sameAs' => [
            'https://www.instagram.com/' . config('veronica.social.instagram'),
            'https://wa.me/' . config('veronica.whatsapp.number'),
        ],
    ];

    $websiteSchema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        'name'            => "Verônica's Fashion",
        'url'             => route('home'),
        'description'     => "Catálogo digital da Verônica's Fashion — boutique feminina premium.",
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => route('catalog.featured'),
            'query-input' => 'required name=search_term_string',
        ],
    ];
?>
<?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => 'Verônica\'s Fashion - Catálogo de Moda Feminina','description' => 'Descubra a elegância da Verônica\'s Fashion. Peças exclusivas de moda feminina premium: vestidos, conjuntos, acessórios e muito mais. Boutique feminina com atendimento personalizado.','url' => route('home'),'type' => 'website','jsonLd' => [$organizationSchema, $websiteSchema]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Verônica\'s Fashion - Catálogo de Moda Feminina','description' => 'Descubra a elegância da Verônica\'s Fashion. Peças exclusivas de moda feminina premium: vestidos, conjuntos, acessórios e muito mais. Boutique feminina com atendimento personalizado.','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('home')),'type' => 'website','json-ld' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([$organizationSchema, $websiteSchema])]); ?>
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

<div>
    
    
    
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Catálogo','subtitle' => 'Explore nossa seleção exclusiva']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Catálogo','subtitle' => 'Explore nossa seleção exclusiva']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banners->isNotEmpty()): ?>
        <div class="mb-16">
            <?php if (isset($component)) { $__componentOriginal7c65c7b292d8ab163b5839aa2f2c30c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c65c7b292d8ab163b5839aa2f2c30c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero-carousel','data' => ['banners' => $banners]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero-carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['banners' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($banners)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c65c7b292d8ab163b5839aa2f2c30c5)): ?>
<?php $attributes = $__attributesOriginal7c65c7b292d8ab163b5839aa2f2c30c5; ?>
<?php unset($__attributesOriginal7c65c7b292d8ab163b5839aa2f2c30c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c65c7b292d8ab163b5839aa2f2c30c5)): ?>
<?php $component = $__componentOriginal7c65c7b292d8ab163b5839aa2f2c30c5; ?>
<?php unset($__componentOriginal7c65c7b292d8ab163b5839aa2f2c30c5); ?>
<?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredProducts->isNotEmpty()): ?>
        <section class="mb-16">
            <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['title' => 'Destaques da Semana','subtitle' => 'Peças especialmente selecionadas para você']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Destaques da Semana','subtitle' => 'Peças especialmente selecionadas para você']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginala87666a6c7dfd023b4375fc379bf394c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala87666a6c7dfd023b4375fc379bf394c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-grid','data' => ['products' => $featuredProducts,'favorites' => $favorites]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredProducts),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $attributes = $__attributesOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $component = $__componentOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__componentOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
            <div class="mt-8 text-center">
                <a href="<?php echo e(route('catalog.featured')); ?>" wire:navigate
                   class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all">
                    Ver mais
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
                </a>
            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newCollection->isNotEmpty()): ?>
        <section class="mb-16">
            <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['title' => 'Nova Coleção','subtitle' => 'As últimas tendências em moda feminina premium']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nova Coleção','subtitle' => 'As últimas tendências em moda feminina premium']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginala87666a6c7dfd023b4375fc379bf394c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala87666a6c7dfd023b4375fc379bf394c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-grid','data' => ['products' => $newCollection,'favorites' => $favorites]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($newCollection),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $attributes = $__attributesOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $component = $__componentOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__componentOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
            <div class="mt-8 text-center">
                <a href="<?php echo e(route('catalog.new')); ?>" wire:navigate
                   class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all">
                    Ver mais
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
                </a>
            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promoProducts->isNotEmpty()): ?>
        <section class="mb-16">
            <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['title' => 'Promoções Especiais','subtitle' => 'Aproveite ofertas exclusivas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Promoções Especiais','subtitle' => 'Aproveite ofertas exclusivas']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginala87666a6c7dfd023b4375fc379bf394c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala87666a6c7dfd023b4375fc379bf394c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-grid','data' => ['products' => $promoProducts,'favorites' => $favorites]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($promoProducts),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $attributes = $__attributesOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__attributesOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala87666a6c7dfd023b4375fc379bf394c)): ?>
<?php $component = $__componentOriginala87666a6c7dfd023b4375fc379bf394c; ?>
<?php unset($__componentOriginala87666a6c7dfd023b4375fc379bf394c); ?>
<?php endif; ?>
            <div class="mt-8 text-center">
                <a href="<?php echo e(route('catalog.sale')); ?>" wire:navigate
                   class="inline-flex items-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-sans text-sm transition-all">
                    Ver mais
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
                </a>
            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/livewire/pages/home.blade.php ENDPATH**/ ?>