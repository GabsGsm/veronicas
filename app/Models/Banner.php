<?php

namespace App\Models;

use Database\Factories\BannerFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    /** @use HasFactory<BannerFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'image_position',
        'cta_label',
        'hide_overlay',
        'collection_id',
        'active',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'hide_overlay' => 'boolean',
            'order' => 'integer',
        ];
    }

    /** @return BelongsTo<Collection, $this> */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(
            fn (): ?string => $this->image ? Storage::disk('public')->url($this->image) : null
        );
    }
}
