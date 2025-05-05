<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class RegisterForm extends Component
{
    public $phone = '';
    public $name = '';
    public $email = '';
    public $vehicle_type = '';
    public $step = 1;
    public $password = '';

    protected $rules = [
        'phone' => 'required|unique:users,phone|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'email' => 'required|email|unique:users,email',
        'name' => 'required|string|max:255',
    ];

    protected $messages = [
        'phone.required' => 'Nomor handphone wajib diisi',
        'phone.unique' => 'Nomor handphone sudah terdaftar',
        'phone.regex' => 'Format nomor handphone tidak valid',
        'phone.min' => 'Nomor handphone minimal 10 digit',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'name.required' => 'Nama wajib diisi',
        'name.max' => 'Nama maksimal 255 karakter',
    ];

    public function nextStep()
    {
        $this->validate();
        $this->step = 2;
    }

    public function register()
    {
        $this->validate([
            'password' => ['required', 'string', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ], [
            'password.required' => 'Password wajib diisi',
        ]);

        $user = User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'vehicle_type' => $this->vehicle_type,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.register-form')
            ->layout('layouts.guest');
    }
}