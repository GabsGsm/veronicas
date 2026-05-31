<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Verônica's Fashion — Configurações da boutique
    |--------------------------------------------------------------------------
    |
    | Configurações de contato e redes sociais. Use env() em produção:
    |   VERONICA_WHATSAPP_NUMBER=5511987654321
    |   VERONICA_INSTAGRAM=veronicasfashion
    |
    */

    'whatsapp' => [
        'number' => env('VERONICA_WHATSAPP_NUMBER', '5511987654321'),
    ],

    'social' => [
        'instagram' => env('VERONICA_INSTAGRAM', 'veronicasfashion'),
    ],

    'contact' => [
        'phone' => env('VERONICA_PHONE_DISPLAY', '(11) 98765-4321'),
        'phones' => env('VERONICA_PHONES_DISPLAY', "(11) 3456-7890\n(11) 98765-4321"),
        'address' => env('VERONICA_ADDRESS', "Rua das Flores, 123\nJardins - São Paulo/SP"),
        'hours' => env('VERONICA_HOURS', "Seg - Sex: 10h às 20h\nSáb: 10h às 18h"),
    ],

    /*
    |--------------------------------------------------------------------------
    | Páginas fixas disponíveis no menu de navegação
    |--------------------------------------------------------------------------
    |
    | Mapa de nome-da-rota => label amigável para o seletor do admin.
    |
    */

    'navigation_pages' => [
        'home' => 'Início',
        'catalog.featured' => 'Destaques',
        'catalog.new' => 'Nova Coleção',
        'catalog.sale' => 'Promoções',
        'favorites' => 'Favoritos',
        'contact' => 'Contato',
    ],
];
