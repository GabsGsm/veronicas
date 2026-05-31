<?php

namespace App\Livewire\Admin\Pages\HomeLayout;

use App\Models\HomeContainer;
use App\Models\HomeSection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Layout da Home')]
class Index extends Component
{
    public function moveContainerUp(int $id): void
    {
        $container = HomeContainer::findOrFail($id);
        $previous = HomeContainer::where('order', '<', $container->order)->orderBy('order', 'desc')->first();

        if ($previous) {
            [$container->order, $previous->order] = [$previous->order, $container->order];
            $container->save();
            $previous->save();
        }
    }

    public function moveContainerDown(int $id): void
    {
        $container = HomeContainer::findOrFail($id);
        $next = HomeContainer::where('order', '>', $container->order)->orderBy('order')->first();

        if ($next) {
            [$container->order, $next->order] = [$next->order, $container->order];
            $container->save();
            $next->save();
        }
    }

    public function toggleContainer(int $id): void
    {
        $container = HomeContainer::findOrFail($id);
        $container->update(['active' => ! $container->active]);
    }

    public function deleteContainer(int $id): void
    {
        HomeContainer::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Container removido.');
    }

    public function moveSectionUp(int $id): void
    {
        $section = HomeSection::findOrFail($id);
        $previous = HomeSection::where('home_container_id', $section->home_container_id)
            ->where('order', '<', $section->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($previous) {
            [$section->order, $previous->order] = [$previous->order, $section->order];
            $section->save();
            $previous->save();
        }
    }

    public function moveSectionDown(int $id): void
    {
        $section = HomeSection::findOrFail($id);
        $next = HomeSection::where('home_container_id', $section->home_container_id)
            ->where('order', '>', $section->order)
            ->orderBy('order')
            ->first();

        if ($next) {
            [$section->order, $next->order] = [$next->order, $section->order];
            $section->save();
            $next->save();
        }
    }

    public function toggleSection(int $id): void
    {
        $section = HomeSection::findOrFail($id);
        $section->update(['active' => ! $section->active]);
    }

    public function deleteSection(int $id): void
    {
        HomeSection::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Seção removida.');
    }

    public function render(): View
    {
        return view('livewire.admin.pages.home-layout.index', [
            'containers' => HomeContainer::orderBy('order')
                ->with(['sections' => fn ($q) => $q->orderBy('order')])
                ->get(),
        ]);
    }
}
