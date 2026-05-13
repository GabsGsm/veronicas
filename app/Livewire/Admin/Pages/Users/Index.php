<?php

namespace App\Livewire\Admin\Pages\Users;

use App\Livewire\Admin\Concerns\HasAdminTable;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Usuários')]
class Index extends Component
{
    use HasAdminTable;

    public function delete(int $id): void
    {
        if ($id === auth()->id()) {
            $this->dispatch('toast', type: 'error', message: 'Você não pode excluir sua própria conta.');
            return;
        }

        User::findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Usuário removido com sucesso.');
    }

    public function render(): View
    {
        $users = User::query()
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            }))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.pages.users.index', compact('users'));
    }
}
