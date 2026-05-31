<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = ['PP', 'P', 'M', 'G', 'GG', 'Único'];

        foreach ($sizes as $i => $label) {
            Size::firstOrCreate(
                ['label' => $label],
                ['active' => true, 'order' => $i]
            );
        }
    }
}
