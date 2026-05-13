<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            [
                'id' => 1,
                'title' => 'Coleção Dia das Mães',
                'slug' => 'colecao-dia-das-maes',
                'subtitle' => 'Elegância que inspira',
                'description' => 'Uma coleção especial criada para celebrar mulheres sofisticadas. Peças únicas que combinam delicadeza e força.',
                'story' => 'Inspirada na força feminina e na elegância atemporal, esta coleção foi cuidadosamente desenhada para homenagear mães que valorizam sofisticação e conforto. Cada peça conta uma história de amor e dedicação.',
                'cover_image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200&auto=format&fit=crop',
                'banner_image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1600&auto=format&fit=crop',
                'featured' => true,
                'order' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Nova Coleção Primavera',
                'slug' => 'nova-colecao-primavera',
                'subtitle' => 'Sofisticação em cada detalhe',
                'description' => 'Peças exclusivas que celebram a leveza e o renascimento. Tecidos nobres em tons suaves que abraçam a estação.',
                'story' => 'A primavera traz renovação, e nossa nova coleção reflete essa energia com peças leves, fluidas e elegantes. Tons pastel, tecidos respiráveis e cortes modernos definem esta seleção premium.',
                'cover_image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200&auto=format&fit=crop',
                'banner_image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600&auto=format&fit=crop',
                'featured' => true,
                'order' => 2,
            ],
            [
                'id' => 3,
                'title' => 'Tendências 2026',
                'slug' => 'tendencias-2026',
                'subtitle' => 'O futuro da moda premium',
                'description' => 'Looks que definem estilo. A vanguarda da moda feminina premium em uma coleção exclusiva e contemporânea.',
                'story' => 'Antecipamos as tendências globais com uma curadoria sofisticada de peças que combinam inovação e atemporalidade. Esta coleção é para mulheres que ditam o futuro da moda.',
                'cover_image' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1200&auto=format&fit=crop',
                'banner_image' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1600&auto=format&fit=crop',
                'featured' => true,
                'order' => 3,
            ],
        ];

        foreach ($collections as $data) {
            Collection::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
