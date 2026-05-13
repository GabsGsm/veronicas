{{--
    <x-editorial-banner :story="$collection->story" :image="$collection->cover_image" />
--}}
@props([
    'story',
    'image',
])

<div class="relative h-[400px] rounded-3xl overflow-hidden my-16 animate-fade-in-up">
    {{-- Background --}}
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $image }}')">
        <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/85 to-transparent"></div>
    </div>

    {{-- Content --}}
    <div class="relative h-full flex items-center px-8 md:px-16">
        <div class="max-w-2xl">
            <div class="inline-block mb-4">
                <span class="text-xs font-sans uppercase tracking-widest text-muted-foreground bg-white/80 px-4 py-2 rounded-full">
                    A História da Coleção
                </span>
            </div>
            <p class="font-sans text-base md:text-lg leading-relaxed text-foreground/90 bg-white/60 backdrop-blur-sm p-6 rounded-2xl">
                {{ $story }}
            </p>
        </div>
    </div>
</div>
