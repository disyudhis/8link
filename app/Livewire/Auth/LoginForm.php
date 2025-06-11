<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginForm extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
    ];

    public function login()
    {
        // Rate limiting untuk mencegah brute force
        $key = Str::transliterate(Str::lower($this->email) . '|' . request()->ip());

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        try {
            if (Auth::attempt($credentials, $this->remember)) {
                // Clear rate limiter setelah login berhasil
                RateLimiter::clear($key);

                session()->regenerate();

                $user = Auth::user();

                // Log aktivitas login
                Log::info('User logged in successfully', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);

                // Reset form
                $this->reset(['email', 'password', 'remember']);

                // Flash message sukses
                session()->flash('success', 'Login berhasil! Selamat datang, ' . $user->name);

                // Redirect berdasarkan user_type
                return $this->redirectBasedOnUserType($user);
            } else {
                // Increment rate limiter untuk login gagal
                RateLimiter::hit($key, 300); // 5 menit

                // Log percobaan login gagal
                Log::warning('Failed login attempt', [
                    'email' => $this->email,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);

                // Reset password field
                $this->password = '';

                // Error message yang tidak memberikan hint
                $this->addError('email', 'Email atau password tidak valid.');
            }
        } catch (\Exception $e) {
            Log::error('Login system error', [
                'email' => $this->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->addError('email', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    /**
     * Redirect user berdasarkan user_type dengan fallback
     */
    private function redirectBasedOnUserType($user)
    {
        $redirectRoutes = [
            'ADMIN' => 'admin.antrian',
            'USER' => 'user.home',
        ];

        $userType = $user->user_type ?? 'customer';
        $routeName = $redirectRoutes[$userType] ?? 'customer.dashboard';

        // Cek apakah route ada
        if (!\Route::has($routeName)) {
            Log::warning("Route {$routeName} not found, redirecting to home", [
                'user_id' => $user->id,
                'user_type' => $userType,
            ]);
            return redirect()->route('home');
        }

        return redirect()->intended(route($routeName));
    }

    /**
     * Real-time validation dengan throttle
     */
    public function updated($propertyName)
    {
        // Hanya validasi field tertentu secara real-time
        if (in_array($propertyName, ['email'])) {
            $this->validateOnly($propertyName);
        }
    }

    /**
     * Reset form
     */
    public function resetForm()
    {
        $this->reset(['email', 'password', 'remember']);
        $this->resetErrorBag();
    }

    /**
     * Check apakah user sudah login
     */
    public function mount()
    {
        // Redirect jika sudah login
        if (Auth::check()) {
            $user = Auth::user();
            return $this->redirectBasedOnUserType($user);
        }
    }

    /**
     * Render view
     */
    public function render()
    {
        return view('livewire.auth.login-form')
            ->layout('layouts.guest')
            ->title('Login - ' . config('app.name'));
    }
}