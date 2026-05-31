{{--
    Carrossel de banners — reutiliza x-hero-carousel.
    <x-home.section-banner-carousel :section="$section" />
--}}
@props([
    'section',
])

@if ($section->data->isNotEmpty())
    <section class="mb-16" wire:key="section-{{ $section->id }}">
        @if ($section->show_title && $section->title)
            <x-section-title :title="$section->title" :subtitle="$section->description" />
        @endif
        <x-hero-carousel :banners="$section->data" />
    </section>
@endif
