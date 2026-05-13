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

    public function mount(): void
    {
        $this->sortBy = 'order';
        $this->sortDir = 'asc';
    }

    public function moveUp(int $id): void
    {
        $item = Collection::findOrFail($id);
        $prev = Collection::where('order', '<', $item->order)->orderByDesc('order')->first();
        if ($prev) {
            [$item->order, $prev->order] = [$prev->order, $item->order];
            $item->save();
            $prev->save();
        }
    }

    public function moveDown(int $id): void
    {
        $item = Collection::findOrFail($id);
        $next = Collection::where('order', '>', $item->order)->orderBy('order')->first();
        if ($next) {
            [$item->order, $next->order] = [$next->order, $item->order];
            $item->save();
            $next->save();
        }
    }

    public function updateOrder(int $id, int $newOrder): void
    {
        Collection::findOrFail($id)->update(['order' => $newOrder]);
    }

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
