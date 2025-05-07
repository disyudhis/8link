<div>
    <div class="min-h-screen bg-primary flex flex-col items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-center mb-6">
                    <div class="rounded-full bg-black w-16 h-16 flex items-center justify-center">
                        <img src="{{ asset('icon/8link yellow (no bg).png') }}" alt="">
                    </div>
                </div>

                <h2 class="text-xl font-semibold mb-1">Login ke Akun Anda</h2>
                <p class="text-gray-500 text-sm mb-6">Silahkan mengisi data dibawah ini</p>

                <form wire:submit.prevent="login">
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input wire:model.live="email" type="text" id="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-secondary"
                            placeholder="Email">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input wire:model.live="password" type="password" id="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-secondary"
                            placeholder="Password">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-2 px-4 bg-primary hover:bg-secondary text-black font-semibold rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50 uppercase">
                        Login
                    </button>
                </form>

                <div class="mt-4 flex justify-between text-sm">
                    <a href="{{ route('register') }}" class="text-gray-600 font-medium">Daftar Akun</a>
                    <a href="{{ route('password.request') }}" class="text-gray-600 font-medium">Lupa Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
