{{--
    <x-page-header
        title="Vestidos"
        subtitle="Do casual ao festa"
        decorative="Elegância em cada detalhe"
    />
--}}
@props([
    'title',
    'subtitle' => null,
    'decorative' => null,
])

<div {{ $attributes->merge(['class' => 'mb-8']) }}>
    @if ($decorative)
        <p class="font-script text-3xl text-primary mb-2 leading-none">
            {{ $decorative }}
        </p>
    @endif

    <h1 class="font-serif text-4xl mb-2 tracking-tight">
        {{ $title }}
    </h1>

    @if ($subtitle)
        <p class="text-muted-foreground font-sans">
            {{ $subtitle }}
        </p>
    @endif
</div>
