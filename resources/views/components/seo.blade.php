@props([
    'title'       => "Verônica's Fashion — Boutique Feminina Premium",
    'description' => "Descubra moda feminina premium na Verônica's Fashion. Peças exclusivas, elegantes e sofisticadas para todas as ocasiões.",
    'image'       => null,
    'url'         => null,
    'type'        => 'website',
    'jsonLd'      => null,
])
@php
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
@endphp

<meta name="description" content="{{ $metaDesc }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="pt_BR">
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $ogDesc }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $title }}">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $ogDesc }}">
<meta name="twitter:image" content="{{ $ogImage }}">

{{-- JSON-LD Structured Data --}}
@if ($schemas)
    @foreach ($schemas as $schema)
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
    @endforeach
@endif
