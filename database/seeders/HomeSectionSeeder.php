<?php

namespace Database\Seeders;

use App\Models\HomeContainer;
use App\Models\HomeSection;
use Illuminate\Database\Seeder;

class HomeSectionSeeder extends Seeder
{
    public function run(): void
    {
        $container = HomeContainer::firstOrCreate(
            ['name' => 'Principal'],
            ['type' => 'full_width', 'order' => 0, 'active' => true]
        );

        $sections = [
            [
                'title' => 'Banners Principais',
                'view_all_position' => 'inline',
                'description' => null,
                'component_type' => 'banner_carousel',
                'data_source' => 'banners',
                'filter_type' => 'all',
                'filter_values' => null,
                'order_by' => 'newest',
                'limit' => 10,
                'show_title' => false,
                'show_view_all' => false,
                'view_all_label' => 'Ver mais',
                'view_all_url' => null,
                'order' => 0,
                'active' => true,
            ],
            [
                'title' => 'Destaques da Semana',
                'description' => 'Peças especialmente selecionadas para você',
                'component_type' => 'cards',
                'data_source' => 'products',
                'filter_type' => 'featured',
                'filter_values' => null,
                'order_by' => 'newest',
                'limit' => 4,
                'show_title' => true,
                'show_view_all' => true,
                'view_all_label' => 'Ver mais',
                'view_all_url' => null,
                'view_all_position' => 'bottom',
                'order' => 0,
                'active' => true,
            ],
            [
                'title' => 'Nova Coleção',
                'description' => 'As últimas tendências em moda feminina premium',
                'component_type' => 'cards',
                'data_source' => 'products',
                'filter_type' => 'tag',
                'filter_values' => ['Nova Coleção'],
                'order_by' => 'newest',
                'limit' => 4,
                'show_title' => true,
                'show_view_all' => true,
                'view_all_label' => 'Ver mais',
                'view_all_url' => null,
                'view_all_position' => 'bottom',
                'order' => 1,
                'active' => true,
            ],
            [
                'title' => 'Promoções Especiais',
                'description' => 'Aproveite ofertas exclusivas',
                'component_type' => 'cards',
                'data_source' => 'products',
                'filter_type' => 'promotional',
                'filter_values' => null,
                'order_by' => 'newest',
                'limit' => 4,
                'show_title' => true,
                'show_view_all' => true,
                'view_all_label' => 'Ver mais',
                'view_all_url' => null,
                'view_all_position' => 'bottom',
                'order' => 2,
                'active' => true,
            ],
        ];

        foreach ($sections as $data) {
            HomeSection::firstOrCreate(
                ['home_container_id' => $container->id, 'title' => $data['title']],
                array_merge($data, ['home_container_id' => $container->id])
            );
        }
    }
}
