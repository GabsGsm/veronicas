<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeContainer extends Model
{
    protected $fillable = [
        'name',
        'type',
        'order',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'order' => 'integer',
        ];
    }

    /** @return HasMany<HomeSection, $this> */
    public function sections(): HasMany
    {
        return $this->hasMany(HomeSection::class)->orderBy('order');
    }

    /** @return HasMany<HomeSection, $this> */
    public function activeSections(): HasMany
    {
        return $this->hasMany(HomeSection::class)->where('active', true)->orderBy('order');
    }
}
