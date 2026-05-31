<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Novo',
            'Nova Coleção',
            'Mais Vendido',
            'Lançamento',
            'Destaque',
            'Premium',
            'Exclusivo',
            'Tendência',
            'Promoção',
            'Outlet',
        ];

        foreach ($tags as $i => $name) {
            Tag::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'active' => true, 'order' => $i]
            );
        }
    }
}
