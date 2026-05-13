{{--
    <x-whatsapp-cta :product-name="$product->name" :product-price="$product->formatted_price" />

    Botão de consulta no WhatsApp. Número padrão pode ser sobrescrito via config('veronica.whatsapp.number').
--}}
@props([
    'productName',
    'productPrice',
])

@php
    $phone = config('veronica.whatsapp.number', '5511987654321');
    $staticMessage = "Olá! Tenho interesse no produto *{$productName}* ({$productPrice}) que vi no catálogo da Verônica's Fashion. 🌸";
    $staticUrl = 'https://wa.me/'.$phone.'?text='.rawurlencode($staticMessage);
@endphp

<a
    href="{{ $staticUrl }}"
    x-data="{
        buildUrl(size, color) {
            let msg = @js("Olá! Tenho interesse no produto *{$productName}* ({$productPrice})");
            if (size) msg += ' - Tamanho: ' + size;
            if (color) msg += ' - Cor: ' + color;
            msg += @js(" que vi no catálogo da Verônica's Fashion. 🌸");
            return @js('https://wa.me/'.$phone) + '?text=' + encodeURIComponent(msg);
        }
    }"
    :href="buildUrl($parent.selectedSize ?? '', $parent.selectedColor ?? '')"
    target="_blank"
    rel="noopener noreferrer"
    class="w-full bg-[#25D366] hover:bg-[#20BD5C] text-white py-4 px-6 rounded-full font-sans transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-3 group active:scale-[0.98]"
>
    <x-icon name="message-circle" class="w-5 h-5 group-hover:scale-110 transition-transform" />
    <span class="text-base">Consultar no WhatsApp</span>
</a>
