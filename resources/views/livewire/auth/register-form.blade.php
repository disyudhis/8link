<div>
    <div class="min-h-screen bg-primary flex flex-col items-center justify-center p-4">
        <div class="w-full max-w-md">
            @if ($step === 1)
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-center mb-6">
                    <div class="rounded-full bg-black w-16 h-16 flex items-center justify-center">
                        <img src="{{ asset('icon/8link yellow (no bg).png') }}" alt="">
                    </div>
                </div>

                <h2 class="text-xl font-semibold mb-1">Anda Belum Terdaftar</h2>
                <p class="text-gray-500 text-sm mb-6">Silahkan mengisi data dibawah ini</p>

                <form wire:submit.prevent="nextStep">
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input wire:model.defer="name" type="text" id="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-secondary"
                            placeholder="Nama Lengkap">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input wire:model.defer="email" type="email" id="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-secondary"
                            placeholder="Email">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone</label>
                        <input wire:model.defer="phone" type="text" id="phone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-secondary"
                            placeholder="08xxxxxxxxxx">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-2 px-4 bg-primary hover:bg-secondary text-white font-semibold rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50 uppercase">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-4 text-center text-sm">
                    <span class="text-gray-600">Sudah Memiliki Akun?</span>
                    <a href="{{ route('login') }}" class="text-gray-800 font-medium ml-1">Login</a>
                </div>
            </div>
            @else
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-start mb-6">
                    <a href="#" wire:click.prevent="$set('step', 1)" class="text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                </div>

                <div class="flex justify-center mb-6">
                    <div class="rounded-full bg-black w-16 h-16 flex items-center justify-center">
                        <img src="{{ asset('icon/8link yellow (no bg).png') }}" alt="">
                    </div>
                </div>

                <h2 class="text-xl font-semibold mb-1">Isikan Password dan</h2>
                <h2 class="text-xl font-semibold mb-2">Anda Menjadi Member Kami</h2>
                <p class="text-gray-500 text-sm mb-6">Dengan mengisi password dibawah Anda akan menjadi member. Dan Anda
                    akan pertama kali mendapat data dari kami untuk diolah kedepannya</p>

                <form wire:submit.prevent="register">
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input wire:model.defer="password" type="password" id="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-secondary">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-2 px-4 bg-primary hover:bg-secondary text-white font-semibold rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50 uppercase">
                        Proses
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
