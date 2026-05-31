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

    /*
    |--------------------------------------------------------------------------
    | Tipos de componente e filtros da Home modular
    |--------------------------------------------------------------------------
    */

    'home_component_types' => [
        'cards' => 'Cards',
        'list' => 'Lista',
        'editorial' => 'Editorial / Destaque',
        'highlight_stack' => 'Destaque + Pilha',
        'highlight_list' => 'Destaque + Lista',
        'high_grid' => 'Grade Elevada',
        'product_carousel' => 'Carrossel de Produtos',
        'banner_carousel' => 'Carrossel de Banners',
        'featured_collection' => 'Coleção Destaque (Hero)',
        'collection_grid' => 'Coleções em Grade',
        'collection_list' => 'Coleções em Lista',
    ],

    'home_filter_types' => [
        'all' => 'Todos os produtos',
        'featured' => 'Em destaque',
        'promotional' => 'Em promoção',
        'new' => 'Mais recentes',
        'category' => 'Por categoria',
        'tag' => 'Por tag',
        'occasion' => 'Por ocasião',
        'collection' => 'Por coleção',
    ],

    'home_order_by' => [
        'newest' => 'Mais recentes',
        'featured' => 'Destaque primeiro',
        'price_asc' => 'Menor preço',
        'price_desc' => 'Maior preço',
        'oldest' => 'Mais antigos',
    ],
];
