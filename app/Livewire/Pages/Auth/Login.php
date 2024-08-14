<?php

namespace App\Livewire\Pages\Auth;

use App\Providers\RouteServiceProvider;
use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public string $email;
    public string $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function render()
    {
        return view('components.livewire.pages.auth.login')->layout('layouts.guest');
    }

    public function updated()
    {
        $this->validate();
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
