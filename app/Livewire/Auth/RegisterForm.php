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
    public $user_type = User::ROLE_USER;
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
        $this->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:20', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'phone.required' => 'Nomor telepon wajib diisi',
                'phone.unique' => 'Nomor telepon sudah terdaftar',
                'email.required' => 'Email wajib diisi',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password wajib diisi',
            ],
        );

        try {
            $user = User::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'user_type' => $this->user_type ?? 'USER', // Default ke customer
                'password' => Hash::make($this->password),
                'email_verified_at' => null, // Akan diverifikasi via email
            ]);

            event(new Registered($user));
            Auth::login($user);

            // Reset form setelah sukses
            $this->reset(['name', 'phone', 'email', 'password']);

            // Redirect berdasarkan user_type
            return $this->redirectBasedOnUserType($user);
        } catch (\Exception $e) {
            $this->addError('register', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
            \Log::error('Registration failed: ' . $e->getMessage());
        }
    }

    private function redirectBasedOnUserType($user)
    {
        switch ($user->user_type) {
            case 'ADMIN':
                return redirect()->route('admin.antrian');
            case 'USER':
                default:
                return redirect()->route('user.home');
        }
    }

    public function render()
    {
        return view('livewire.auth.register-form')->layout('layouts.guest');
    }
}
