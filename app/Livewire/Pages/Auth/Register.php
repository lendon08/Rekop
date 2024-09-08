<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Register - EZSEO')]
class Register extends Component
{   
    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required'
    ];

    public function updated()
    {
        $this->validate();
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {   
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
