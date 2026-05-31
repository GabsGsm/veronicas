<?php

namespace App\Livewire\Admin\Pages\Tags;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Nova Tag')]
class Create extends Component
{
    public string $name = '';

    public int $order = 0;

    public bool $active = true;

    public function mount(): void
    {
        $this->order = (Tag::max('order') ?? -1) + 1;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        Tag::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Tag criada com sucesso.');
        $this->redirect(route('admin.tags.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.tags.create');
    }
}
