<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Coleção Dia das Mães',
                'subtitle' => 'Elegância que inspira',
                'description' => 'Descubra a nova seleção premium',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200&auto=format&fit=crop',
                'cta_label' => 'Explorar Coleção',
                'collection_id' => 1,
                'order' => 1,
            ],
            [
                'title' => 'Nova Coleção Primavera',
                'subtitle' => 'Sofisticação em cada detalhe',
                'description' => 'Peças exclusivas para você',
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200&auto=format&fit=crop',
                'cta_label' => 'Explorar Coleção',
                'collection_id' => 2,
                'order' => 2,
            ],
            [
                'title' => 'Tendências 2026',
                'subtitle' => 'O futuro da moda premium',
                'description' => 'Looks que definem estilo',
                'image' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1200&auto=format&fit=crop',
                'cta_label' => 'Explorar Coleção',
                'collection_id' => 3,
                'order' => 3,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['title' => $banner['title']],
                $banner
            );
        }
    }
}
