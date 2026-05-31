<?php

namespace App\Livewire\Admin\Pages\Tags;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Editar Tag')]
class Edit extends Component
{
    public int $tagId;

    public string $name = '';

    public int $order = 0;

    public bool $active = true;

    public function mount(int $id): void
    {
        $tag = Tag::findOrFail($id);
        $this->tagId = $tag->id;
        $this->name = $tag->name;
        $this->order = $tag->order;
        $this->active = $tag->active;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        Tag::findOrFail($this->tagId)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'order' => $this->order,
            'active' => $this->active,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Tag atualizada com sucesso.');
        $this->redirect(route('admin.tags.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.tags.edit');
    }
}
