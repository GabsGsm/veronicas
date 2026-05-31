<?php

namespace App\Livewire\Admin\Pages\Navigation;

use App\Models\Category;
use App\Models\Collection;
use App\Models\MenuItem;
use App\Models\Occasion;
use App\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Novo Item de Menu')]
class Create extends Component
{
    public string $label = '';

    public string $icon = '';

    public string $type = 'fixed';

    public string $type_value = '';

    public bool $active = true;

    public int $order = 0;

    public function mount(): void
    {
        $this->order = (MenuItem::max('order') ?? -1) + 1;
    }

    public function updatedType(): void
    {
        $this->type_value = '';
    }

    public function save(): void
    {
        $this->validate([
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'type' => 'required|in:fixed,category,occasion,tag,collection',
            'type_value' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        MenuItem::create([
            'label' => $this->label,
            'icon' => $this->icon ?: null,
            'type' => $this->type,
            'type_value' => $this->type_value ?: null,
            'active' => $this->active,
            'order' => $this->order,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Item de menu criado com sucesso.');
        $this->redirect(route('admin.navigation.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.navigation.create', [
            'navigationPages' => config('veronica.navigation_pages', []),
            'categories' => Category::where('active', true)->orderBy('name')->get(),
            'occasions' => Occasion::where('active', true)->orderBy('name')->get(),
            'tags' => Tag::where('active', true)->orderBy('name')->get(),
            'collections' => Collection::where('active', true)->orderBy('title')->get(),
            'availableIcons' => self::iconList(),
        ]);
    }

    /** @return array<int, string> */
    public static function iconList(): array
    {
        $icons = [
            'arrow-left', 'check', 'chevron-left', 'chevron-right', 'circle', 'clock',
            'coffee', 'droplet', 'filter', 'flame', 'gem', 'gift', 'heart', 'home',
            'instagram', 'mail', 'map-pin', 'menu', 'message-circle', 'package',
            'party-popper', 'phone', 'scissors', 'shield', 'shirt', 'shopping-bag',
            'sparkles', 'star', 'sun', 'tag', 'watch', 'x', 'zoom-in',
        ];
        sort($icons);

        return $icons;
    }
}
