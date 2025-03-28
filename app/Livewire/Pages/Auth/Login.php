<?php

namespace App\Livewire\Pages\Auth;

use App\Providers\RouteServiceProvider;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Login - EZSEO')]
class Login extends Component
{
    #[Validate('required', as: 'Email')]
    #[Validate('email', message: 'Please enter a valid Email Address.')]
    public string $email;

    #[Validate('required', as: 'Password')]
    #[Validate('min:6', message: 'The password must be have atleast 6 characters.')]
    public string $password;

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function submit()
    {

        if (!Auth::attempt($this->validate())) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        request()->session()->regenerate();

        //Sesson user here
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy()
    {

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('login');
    }
}
