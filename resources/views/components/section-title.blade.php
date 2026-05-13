{{--
    <x-section-title
        title="Destaques da Semana"
        subtitle="Peças especialmente selecionadas para você"
    />
--}}
@props([
    'title',
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    <h2 class="font-serif text-3xl mb-2 tracking-tight">{{ $title }}</h2>
    @if ($subtitle)
        <p class="text-muted-foreground font-sans">{{ $subtitle }}</p>
    @endif
</div>
