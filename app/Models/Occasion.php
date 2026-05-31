<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'active',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'order' => 'integer',
        ];
    }
}
