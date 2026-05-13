<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price_cents',
        'promotional_price_cents',
        'category_id',
        'collection_id',
        'fabric',
        'fabric_details',
        'care',
        'occasion',
        'tag',
        'sizes',
        'colors',
        'primary_image',
        'gallery',
        'featured',
        'active',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'care' => 'array',
            'sizes' => 'array',
            'colors' => 'array',
            'gallery' => 'array',
            'price_cents' => 'integer',
            'promotional_price_cents' => 'integer',
            'featured' => 'boolean',
            'active' => 'boolean',
            'order' => 'integer',
        ];
    }

    /** @return BelongsTo<Category, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** @return BelongsTo<Collection, $this> */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    // ACESSORS
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

    /**
     * Preço corrente formatado em BRL (considera o promocional se houver).
     * Mantém o formato do React: "R$ 249,90".
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::get(fn (): string => $this->formatBrl(
            $this->promotional_price_cents ?? $this->price_cents
        ));
    }

    /**
     * Preço original (riscado) — só existe quando há promoção.
     */
    protected function formattedOriginalPrice(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->promotional_price_cents !== null
            ? $this->formatBrl($this->price_cents)
            : null
        );
    }

    /**
     * Galeria pronta para uso (fallback para a imagem primária).
     *
     * @return Attribute<array<int, string>, never>
     */
    protected function images(): Attribute
    {
        return Attribute::get(function (): array {
            $gallery = $this->gallery ?? [];

            $paths = $gallery === [] && $this->primary_image !== null
                ? [$this->primary_image]
                : $gallery;

            return array_map(fn (string $p) => Storage::url($p), $paths);
        });
    }

    public function isOnSale(): bool
    {
        return $this->promotional_price_cents !== null;
    }

    private function formatBrl(int $cents): string
    {
        return 'R$ '.number_format($cents / 100, 2, ',', '.');
    }
}
