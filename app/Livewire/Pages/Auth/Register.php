<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Register - EZSEO')]
class Register extends Component
{

    public string $company_name;
    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;

    protected $rules = [
        'company_name' => 'required|min:3',
        'name' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required'
    ];


    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {


        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['company_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Company::create([
        //     'name' => $validated['company_name'],
        // ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
