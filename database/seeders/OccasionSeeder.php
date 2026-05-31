<?php

namespace Database\Seeders;

use App\Models\Occasion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OccasionSeeder extends Seeder
{
    public function run(): void
    {
        $occasions = ['Casual', 'Festa', 'Trabalho', 'Especial'];

        foreach ($occasions as $i => $name) {
            Occasion::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'active' => true, 'order' => $i]
            );
        }
    }
}
