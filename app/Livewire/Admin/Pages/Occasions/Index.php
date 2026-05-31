<?php

namespace App\Livewire\Admin\Pages\Occasions;

use App\Livewire\Admin\Concerns\HasAdminTable;
use App\Models\Occasion;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Ocasiões')]
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
        $item = Occasion::findOrFail($id);
        $prev = Occasion::where('order', '<', $item->order)->orderByDesc('order')->first();
        if ($prev) {
            [$item->order, $prev->order] = [$prev->order, $item->order];
            $item->save();
            $prev->save();
        }
    }

    public function moveDown(int $id): void
    {
        $item = Occasion::findOrFail($id);
        $next = Occasion::where('order', '>', $item->order)->orderBy('order')->first();
        if ($next) {
            [$item->order, $next->order] = [$next->order, $item->order];
            $item->save();
            $next->save();
        }
    }

    public function updateOrder(int $id, int $newOrder): void
    {
        Occasion::findOrFail($id)->update(['order' => $newOrder]);
    }

    public function delete(int $id): void
    {
        Occasion::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Ocasião removida com sucesso.');
    }

    public function render(): View
    {
        $occasions = Occasion::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.pages.occasions.index', compact('occasions'));
    }
}
