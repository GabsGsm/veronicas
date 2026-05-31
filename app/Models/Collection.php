<?php

namespace App\Models;

use Database\Factories\CollectionFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Collection extends Model
{
    /** @use HasFactory<CollectionFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'description',
        'story',
        'cover_image',
        'banner_image',
        'active',
        'featured',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'featured' => 'boolean',
            'order' => 'integer',
        ];
    }

    /** @return HasMany<Product, $this> */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /** @return HasMany<Banner, $this> */
    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }

    protected function coverImageUrl(): Attribute
    {
        return Attribute::get(
            fn (): ?string => $this->cover_image ? Storage::disk('public')->url($this->cover_image) : null
        );
    }

    protected function bannerImageUrl(): Attribute
    {
        return Attribute::get(
            fn (): ?string => $this->banner_image ? Storage::disk('public')->url($this->banner_image) : null
        );
    }
}
