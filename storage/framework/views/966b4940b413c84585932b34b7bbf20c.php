
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['banners']));

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

foreach (array_filter((['banners']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $slides = collect($banners)->map(fn ($b) => [
        'id' => $b->id,
        'title' => $b->title,
        'subtitle' => $b->subtitle,
        'description' => $b->description,
        'image' => $b->image_url,
        'image_position' => $b->image_position ?? 'center',
        'hide_overlay' => $b->hide_overlay,
        'cta_label' => $b->cta_label ?? 'Explorar Coleção',
        'href' => $b->collection_id ? route('collection.show', $b->collection->slug) : null,
    ])->values()->all();
?>

<div
    x-data="{
        current: 0,
        slides: <?php echo \Illuminate\Support\Js::from($slides)->toHtml() ?>,
        timer: null,
        next() { this.current = (this.current + 1) % this.slides.length; },
        prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length; },
        go(i) { this.current = i; this.restart(); },
        start() { this.timer = setInterval(() => this.next(), 6000); },
        restart() { clearInterval(this.timer); this.start(); }
    }"
    x-init="start()"
    @mouseenter="clearInterval(timer)"
    @mouseleave="restart()"
    class="relative min-h-64 aspect-[3/2] sm:aspect-video lg:aspect-[21/9] max-h-[620px] rounded-2xl overflow-hidden bg-card shadow-premium"
>
    
    <template x-for="(slide, index) in slides" :key="slide.id">
        <div
            class="absolute inset-0 transition-opacity duration-700"
            x-show="current === index"
            x-transition:enter="transition-opacity duration-700"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="display: none;"
        >
            
            <img
                :src="slide.image"
                :alt="slide.title"
                class="absolute inset-0 w-full h-full object-cover"
                :style="`object-position: ${slide.image_position || 'center'}`"
                loading="lazy"
            >

            
            <div
                class="absolute inset-0 bg-linear-to-r from-black/60 via-black/40 to-transparent"
                x-show="!slide.hide_overlay"
            ></div>

            
            <template x-if="!slide.hide_overlay">
                <div class="absolute inset-0 flex flex-col justify-center px-6 sm:px-12 md:px-16 text-white max-w-2xl">
                    <p class="font-script text-2xl md:text-3xl mb-2 animate-fade-in-up" x-text="slide.subtitle"></p>
                    <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl mb-4 leading-tight animate-fade-in-up" x-text="slide.title"></h2>
                    <p class="font-sans text-base sm:text-lg mb-6 max-w-md animate-fade-in-up" x-text="slide.description"></p>

                    <template x-if="slide.href">
                        <a
                            :href="slide.href"
                            wire:navigate
                            class="bg-primary hover:bg-rose-600 text-white px-8 py-3 rounded-full font-sans text-sm w-fit transition-all shadow-md hover:shadow-lg animate-fade-in-up"
                            x-text="slide.cta_label"
                        ></a>
                    </template>
                    <template x-if="!slide.href">
                        <span class="bg-primary text-white px-8 py-3 rounded-full font-sans text-sm w-fit shadow-md" x-text="slide.cta_label"></span>
                    </template>
                </div>
            </template>

            
            <template x-if="slide.hide_overlay && slide.href">
                <a :href="slide.href" wire:navigate class="absolute inset-0 z-10" :aria-label="slide.title"></a>
            </template>
        </div>
    </template>

    
    <button
        type="button"
        @click="prev(); restart();"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white p-3 rounded-full transition-all z-10"
        aria-label="Slide anterior"
    >
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-left','class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-left','class' => 'w-6 h-6']); ?>
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

    <button
        type="button"
        @click="next(); restart();"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white p-3 rounded-full transition-all z-10"
        aria-label="Próximo slide"
    >
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-right','class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-right','class' => 'w-6 h-6']); ?>
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

    
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-10">
        <template x-for="(_, index) in slides" :key="index">
            <button
                type="button"
                @click="go(index)"
                class="h-2 rounded-full transition-all"
                :class="current === index ? 'w-8 bg-white' : 'w-2 bg-white/50 hover:bg-white/70'"
                :aria-label="`Ir para slide ${index + 1}`"
            ></button>
        </template>
    </div>
</div>
<?php /**PATH C:\Users\raku_\Desktop\Vulpi Studio\Veronicas_Fashion\veronica-fashion\resources\views/components/hero-carousel.blade.php ENDPATH**/ ?>