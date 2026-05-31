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

    
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $containers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $container): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $container->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($section->data->isNotEmpty()): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($section->component_type):
                    case ('cards'): ?>
                        <?php if (isset($component)) { $__componentOriginal013314ba3262869ef1c8314e46a0dabf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal013314ba3262869ef1c8314e46a0dabf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-products','data' => ['section' => $section,'favorites' => $favorites,'layout' => 'cards']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-products'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites),'layout' => 'cards']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal013314ba3262869ef1c8314e46a0dabf)): ?>
<?php $attributes = $__attributesOriginal013314ba3262869ef1c8314e46a0dabf; ?>
<?php unset($__attributesOriginal013314ba3262869ef1c8314e46a0dabf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal013314ba3262869ef1c8314e46a0dabf)): ?>
<?php $component = $__componentOriginal013314ba3262869ef1c8314e46a0dabf; ?>
<?php unset($__componentOriginal013314ba3262869ef1c8314e46a0dabf); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('list'): ?>
                        <?php if (isset($component)) { $__componentOriginal013314ba3262869ef1c8314e46a0dabf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal013314ba3262869ef1c8314e46a0dabf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-products','data' => ['section' => $section,'favorites' => $favorites,'layout' => 'list']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-products'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites),'layout' => 'list']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal013314ba3262869ef1c8314e46a0dabf)): ?>
<?php $attributes = $__attributesOriginal013314ba3262869ef1c8314e46a0dabf; ?>
<?php unset($__attributesOriginal013314ba3262869ef1c8314e46a0dabf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal013314ba3262869ef1c8314e46a0dabf)): ?>
<?php $component = $__componentOriginal013314ba3262869ef1c8314e46a0dabf; ?>
<?php unset($__componentOriginal013314ba3262869ef1c8314e46a0dabf); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('high_grid'): ?>
                        <?php if (isset($component)) { $__componentOriginalc6539d43ff48afdc38c2b3a6244f4a37 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc6539d43ff48afdc38c2b3a6244f4a37 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-high-grid','data' => ['section' => $section,'favorites' => $favorites]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-high-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc6539d43ff48afdc38c2b3a6244f4a37)): ?>
<?php $attributes = $__attributesOriginalc6539d43ff48afdc38c2b3a6244f4a37; ?>
<?php unset($__attributesOriginalc6539d43ff48afdc38c2b3a6244f4a37); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6539d43ff48afdc38c2b3a6244f4a37)): ?>
<?php $component = $__componentOriginalc6539d43ff48afdc38c2b3a6244f4a37; ?>
<?php unset($__componentOriginalc6539d43ff48afdc38c2b3a6244f4a37); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('editorial'): ?>
                        <?php if (isset($component)) { $__componentOriginaldc14074dbba501f35ac542927fc3f42c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc14074dbba501f35ac542927fc3f42c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-editorial','data' => ['section' => $section,'favorites' => $favorites]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-editorial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc14074dbba501f35ac542927fc3f42c)): ?>
<?php $attributes = $__attributesOriginaldc14074dbba501f35ac542927fc3f42c; ?>
<?php unset($__attributesOriginaldc14074dbba501f35ac542927fc3f42c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc14074dbba501f35ac542927fc3f42c)): ?>
<?php $component = $__componentOriginaldc14074dbba501f35ac542927fc3f42c; ?>
<?php unset($__componentOriginaldc14074dbba501f35ac542927fc3f42c); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('highlight_stack'): ?>
                        <?php if (isset($component)) { $__componentOriginalc3548864a3df79bbac079ffbf1f5eee0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc3548864a3df79bbac079ffbf1f5eee0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-highlight','data' => ['section' => $section,'favorites' => $favorites,'mode' => 'stack']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-highlight'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites),'mode' => 'stack']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc3548864a3df79bbac079ffbf1f5eee0)): ?>
<?php $attributes = $__attributesOriginalc3548864a3df79bbac079ffbf1f5eee0; ?>
<?php unset($__attributesOriginalc3548864a3df79bbac079ffbf1f5eee0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc3548864a3df79bbac079ffbf1f5eee0)): ?>
<?php $component = $__componentOriginalc3548864a3df79bbac079ffbf1f5eee0; ?>
<?php unset($__componentOriginalc3548864a3df79bbac079ffbf1f5eee0); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('highlight_list'): ?>
                        <?php if (isset($component)) { $__componentOriginalc3548864a3df79bbac079ffbf1f5eee0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc3548864a3df79bbac079ffbf1f5eee0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-highlight','data' => ['section' => $section,'favorites' => $favorites,'mode' => 'list']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-highlight'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites),'mode' => 'list']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc3548864a3df79bbac079ffbf1f5eee0)): ?>
<?php $attributes = $__attributesOriginalc3548864a3df79bbac079ffbf1f5eee0; ?>
<?php unset($__attributesOriginalc3548864a3df79bbac079ffbf1f5eee0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc3548864a3df79bbac079ffbf1f5eee0)): ?>
<?php $component = $__componentOriginalc3548864a3df79bbac079ffbf1f5eee0; ?>
<?php unset($__componentOriginalc3548864a3df79bbac079ffbf1f5eee0); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('product_carousel'): ?>
                        <?php if (isset($component)) { $__componentOriginal12d0b256b523448360125eace09af447 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12d0b256b523448360125eace09af447 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-product-carousel','data' => ['section' => $section,'favorites' => $favorites]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-product-carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'favorites' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($favorites)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12d0b256b523448360125eace09af447)): ?>
<?php $attributes = $__attributesOriginal12d0b256b523448360125eace09af447; ?>
<?php unset($__attributesOriginal12d0b256b523448360125eace09af447); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12d0b256b523448360125eace09af447)): ?>
<?php $component = $__componentOriginal12d0b256b523448360125eace09af447; ?>
<?php unset($__componentOriginal12d0b256b523448360125eace09af447); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('banner_carousel'): ?>
                        <?php if (isset($component)) { $__componentOriginalb85ec5e8d71c1122c80341621d973c04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb85ec5e8d71c1122c80341621d973c04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-banner-carousel','data' => ['section' => $section]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-banner-carousel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb85ec5e8d71c1122c80341621d973c04)): ?>
<?php $attributes = $__attributesOriginalb85ec5e8d71c1122c80341621d973c04; ?>
<?php unset($__attributesOriginalb85ec5e8d71c1122c80341621d973c04); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb85ec5e8d71c1122c80341621d973c04)): ?>
<?php $component = $__componentOriginalb85ec5e8d71c1122c80341621d973c04; ?>
<?php unset($__componentOriginalb85ec5e8d71c1122c80341621d973c04); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('featured_collection'): ?>
                        <?php if (isset($component)) { $__componentOriginal9ad0201162f67e5385e1d303d38e9c9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-collection','data' => ['section' => $section,'layout' => 'hero']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-collection'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'layout' => 'hero']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d)): ?>
<?php $attributes = $__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d; ?>
<?php unset($__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ad0201162f67e5385e1d303d38e9c9d)): ?>
<?php $component = $__componentOriginal9ad0201162f67e5385e1d303d38e9c9d; ?>
<?php unset($__componentOriginal9ad0201162f67e5385e1d303d38e9c9d); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('collection_grid'): ?>
                        <?php if (isset($component)) { $__componentOriginal9ad0201162f67e5385e1d303d38e9c9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-collection','data' => ['section' => $section,'layout' => 'grid']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-collection'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'layout' => 'grid']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d)): ?>
<?php $attributes = $__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d; ?>
<?php unset($__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ad0201162f67e5385e1d303d38e9c9d)): ?>
<?php $component = $__componentOriginal9ad0201162f67e5385e1d303d38e9c9d; ?>
<?php unset($__componentOriginal9ad0201162f67e5385e1d303d38e9c9d); ?>
<?php endif; ?>
                        <?php break; ?>
                    <?php case ('collection_list'): ?>
                        <?php if (isset($component)) { $__componentOriginal9ad0201162f67e5385e1d303d38e9c9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.home.section-collection','data' => ['section' => $section,'layout' => 'list']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home.section-collection'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($section),'layout' => 'list']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d)): ?>
<?php $attributes = $__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d; ?>
<?php unset($__attributesOriginal9ad0201162f67e5385e1d303d38e9c9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ad0201162f67e5385e1d303d38e9c9d)): ?>
<?php $component = $__componentOriginal9ad0201162f67e5385e1d303d38e9c9d; ?>
<?php unset($__componentOriginal9ad0201162f67e5385e1d303d38e9c9d); ?>
<?php endif; ?>
                        <?php break; ?>
                <?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
</div>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/livewire/pages/home.blade.php ENDPATH**/ ?>