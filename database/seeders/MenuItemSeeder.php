<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['label' => 'Início',       'icon' => 'home',         'type' => 'fixed',    'type_value' => 'home'],
            ['label' => 'Destaques',    'icon' => 'sparkles',     'type' => 'fixed',    'type_value' => 'catalog.featured'],
            ['label' => 'Nova Coleção', 'icon' => 'shopping-bag', 'type' => 'tag',      'type_value' => 'nova-colecao'],
            ['label' => 'Vestidos',     'icon' => 'shirt',        'type' => 'category', 'type_value' => 'vestidos'],
            ['label' => 'Conjuntos',    'icon' => 'package',      'type' => 'category', 'type_value' => 'conjuntos'],
            ['label' => 'Casual',       'icon' => 'coffee',       'type' => 'category', 'type_value' => 'casual'],
            ['label' => 'Festa',        'icon' => 'party-popper', 'type' => 'occasion', 'type_value' => 'festa'],
            ['label' => 'Acessórios',   'icon' => 'watch',        'type' => 'category', 'type_value' => 'acessorios'],
            ['label' => 'Promoções',    'icon' => 'tag',          'type' => 'fixed',    'type_value' => 'catalog.sale'],
            ['label' => 'Favoritos',    'icon' => 'heart',        'type' => 'fixed',    'type_value' => 'favorites'],
            ['label' => 'Contato',      'icon' => 'mail',         'type' => 'fixed',    'type_value' => 'contact'],
        ];

        foreach ($items as $i => $item) {
            MenuItem::firstOrCreate(
                ['label' => $item['label'], 'type' => $item['type'], 'type_value' => $item['type_value']],
                ['icon' => $item['icon'], 'active' => true, 'order' => $i]
            );
        }
    }
}
