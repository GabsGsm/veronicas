<?php

namespace App\Livewire\Concerns;

use Livewire\Attributes\On;

trait ManagesFavorites
{
    /** @var array<int, int> */
    public array $favorites = [];

    public function bootManagesFavorites(): void
    {
        $this->favorites = session('favorites', []);
    }

    #[On('favorite-toggle')]
    public function toggleFavorite(int $id): void
    {
        $favorites = session('favorites', []);

        if (in_array($id, $favorites, true)) {
            $favorites = array_values(array_diff($favorites, [$id]));
        } else {
            $favorites[] = $id;
        }

        session(['favorites' => $favorites]);
        $this->favorites = $favorites;
    }
}
