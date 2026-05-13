<?php

namespace App\Livewire\Admin\Pages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Entrar')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $key = 'login.'.strtolower($this->email).'|'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('email', "Muitas tentativas. Tente novamente em {$seconds}s.");

            return;
        }

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::clear($key);
            session()->regenerate();
            $this->redirect(route('admin.dashboard'), navigate: true);

            return;
        }

        RateLimiter::hit($key, 60);
        $this->addError('email', 'Credenciais inválidas.');
        $this->reset('password');
    }

    public function render(): View
    {
        return view('livewire.admin.pages.login');
    }
}
