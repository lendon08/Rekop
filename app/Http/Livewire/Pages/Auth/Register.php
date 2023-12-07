<?php

namespace App\Http\Livewire\Pages\Auth;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

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

    public function render()
    {
        return view('livewire.pages.auth.register')->layout('layouts.guest');
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
