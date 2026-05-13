<?php

namespace App\Livewire\Admin\Pages\Collections;

use App\Livewire\Admin\Concerns\HasAdminTable;
use App\Models\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Coleções')]
class Index extends Component
{
    use HasAdminTable;

    public function delete(int $id): void
    {
        Collection::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Coleção removida com sucesso.');
    }

    public function render(): View
    {
        $collections = Collection::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.pages.collections.index', compact('collections'));
    }
}
