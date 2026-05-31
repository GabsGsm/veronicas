<?php

namespace App\Livewire\Admin\Pages\Tags;

use App\Livewire\Admin\Concerns\HasAdminTable;
use App\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Tags')]
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
        $item = Tag::findOrFail($id);
        $prev = Tag::where('order', '<', $item->order)->orderByDesc('order')->first();
        if ($prev) {
            [$item->order, $prev->order] = [$prev->order, $item->order];
            $item->save();
            $prev->save();
        }
    }

    public function moveDown(int $id): void
    {
        $item = Tag::findOrFail($id);
        $next = Tag::where('order', '>', $item->order)->orderBy('order')->first();
        if ($next) {
            [$item->order, $next->order] = [$next->order, $item->order];
            $item->save();
            $next->save();
        }
    }

    public function updateOrder(int $id, int $newOrder): void
    {
        Tag::findOrFail($id)->update(['order' => $newOrder]);
    }

    public function delete(int $id): void
    {
        Tag::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Tag removida com sucesso.');
    }

    public function render(): View
    {
        $tags = Tag::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.pages.tags.index', compact('tags'));
    }
}
