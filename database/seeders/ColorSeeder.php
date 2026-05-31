<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['name' => 'Preto',       'hex_code' => '#000000'],
            ['name' => 'Branco',      'hex_code' => '#FFFFFF'],
            ['name' => 'Off-white',   'hex_code' => '#FAF7F2'],
            ['name' => 'Cinza',       'hex_code' => '#9E9E9E'],
            ['name' => 'Grafite',     'hex_code' => '#424242'],
            ['name' => 'Nude',        'hex_code' => '#E8C9A0'],
            ['name' => 'Bege',        'hex_code' => '#D4B896'],
            ['name' => 'Caramelo',    'hex_code' => '#C68642'],
            ['name' => 'Marrom',      'hex_code' => '#795548'],
            ['name' => 'Terracota',   'hex_code' => '#C1440E'],
            ['name' => 'Rosé',        'hex_code' => '#F4A7B9'],
            ['name' => 'Rosa',        'hex_code' => '#E91E8C'],
            ['name' => 'Pink',        'hex_code' => '#FF4081'],
            ['name' => 'Vermelho',    'hex_code' => '#F44336'],
            ['name' => 'Bordô',       'hex_code' => '#880E4F'],
            ['name' => 'Laranja',     'hex_code' => '#FF9800'],
            ['name' => 'Coral',       'hex_code' => '#FF6F61'],
            ['name' => 'Amarelo',     'hex_code' => '#FFEB3B'],
            ['name' => 'Mostarda',    'hex_code' => '#FFC107'],
            ['name' => 'Verde',       'hex_code' => '#4CAF50'],
            ['name' => 'Verde-oliva', 'hex_code' => '#8D9121'],
            ['name' => 'Verde-menta', 'hex_code' => '#A8E6CF'],
            ['name' => 'Azul',        'hex_code' => '#2196F3'],
            ['name' => 'Azul-marinho', 'hex_code' => '#1A237E'],
            ['name' => 'Azul-bebê',   'hex_code' => '#B3E5FC'],
            ['name' => 'Lilás',       'hex_code' => '#CE93D8'],
            ['name' => 'Roxo',        'hex_code' => '#9C27B0'],
            ['name' => 'Champagne',   'hex_code' => '#F7E7CE'],
            ['name' => 'Dourado',     'hex_code' => '#FFD700'],
            ['name' => 'Prateado',    'hex_code' => '#C0C0C0'],
        ];

        foreach ($colors as $i => $color) {
            Color::firstOrCreate(
                ['name' => $color['name']],
                ['hex_code' => $color['hex_code'], 'active' => true, 'order' => $i]
            );
        }
    }
}
