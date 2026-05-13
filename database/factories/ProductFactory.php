<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->sentence(3);
        $price = $this->faker->numberBetween(15_000, 60_000);

        return [
            'name' => rtrim($name, '.'),
            'slug' => Str::slug($name).'-'.Str::random(5),
            'short_description' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price_cents' => $price,
            'promotional_price_cents' => null,
            'category_id' => null,
            'collection_id' => null,
            'fabric' => $this->faker->randomElement(['Seda', 'Linho', 'Crepe', 'Cetim', 'Chiffon', 'Tule', 'Alfaiataria']),
            'fabric_details' => $this->faker->sentence(),
            'care' => ['Lavar a seco', 'Passar em temperatura baixa'],
            'occasion' => $this->faker->randomElement(['Casual', 'Festa', 'Trabalho', 'Especial']),
            'tag' => null,
            'sizes' => ['P', 'M', 'G'],
            'colors' => ['Rosé', 'Nude'],
            'primary_image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=600&auto=format&fit=crop',
            'gallery' => [
                'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=800&auto=format&fit=crop',
            ],
            'featured' => false,
            'active' => true,
            'order' => 0,
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (): array => ['featured' => true]);
    }

    public function onSale(): static
    {
        return $this->state(fn (array $attrs): array => [
            'tag' => 'Promoção',
            'promotional_price_cents' => (int) ($attrs['price_cents'] * 0.7),
        ]);
    }
}
