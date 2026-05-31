<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'label',
        'icon',
        'type',
        'type_value',
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

    public function url(): string
    {
        return match ($this->type) {
            'fixed' => route($this->type_value),
            'category' => route('catalog.category', ['category' => $this->type_value]),
            'occasion' => route('catalog.occasion', ['occasion' => $this->type_value]),
            'tag' => route('catalog.tag', ['tag' => $this->type_value]),
            'collection' => route('collection.show', ['slug' => $this->type_value]),
            default => route('home'),
        };
    }

    public function routeName(): string
    {
        return match ($this->type) {
            'fixed' => $this->type_value ?? 'home',
            'category' => 'catalog.category',
            'occasion' => 'catalog.occasion',
            'tag' => 'catalog.tag',
            'collection' => 'collection.show',
            default => 'home',
        };
    }
}
