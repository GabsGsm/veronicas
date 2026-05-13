<?php

namespace App\Livewire\Admin\Pages\Users;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Editar Usuário')]
class Edit extends Component
{
    public int $userId;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'admin';

    public function mount(int $id): void
    {
        $user           = User::findOrFail($id);
        $this->userId   = $user->id;
        $this->name     = $user->name;
        $this->email    = $user->email;
        $this->role     = $user->role;
    }

    public function save(): void
    {
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$this->userId}",
        ];

        if (filled($this->password)) {
            $rules['password']              = 'min:8|confirmed';
            $rules['password_confirmation'] = 'required';
        }

        $this->validate($rules);

        $user = User::findOrFail($this->userId);

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
        ];

        if (filled($this->password)) {
            $data['password'] = $this->password;
        }

        $user->update($data);

        $this->dispatch('toast', type: 'success', message: 'Usuário atualizado com sucesso.');
        $this->redirect(route('admin.users.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.users.edit');
    }
}
