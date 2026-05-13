<?php

namespace App\Livewire\Admin\Pages\Banners;

use App\Livewire\Admin\Concerns\HasAdminTable;
use App\Models\Banner;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Banners')]
class Index extends Component
{
    use HasAdminTable;

    public function delete(int $id): void
    {
        Banner::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Banner removido com sucesso.');
    }

    public function render(): View
    {
        $banners = Banner::query()
            ->with('collection')
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.pages.banners.index', compact('banners'));
    }
}
