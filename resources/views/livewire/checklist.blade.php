<div>
    <div class="bg-gradient-to-r from-primary to-primary/80 text-black p-4 rounded-b-lg shadow-md">
        <div class="flex items-center">
            <a href="{{ route('reservasi.show', $booking->id) }}" class="text-black hover:text-gray-800 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold">Checklist Kendaraan</h1>
        </div>
        <p class="text-sm opacity-80">Tambahkan foto area yang perlu perbaikan</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-r-lg animate-fade-in" role="alert">
            <p class="font-medium">{{ session('message') }}</p>
        </div>
    @endif

    <!-- Vehicle Diagram and Inspection Form -->
    <div class="bg-white rounded-lg shadow-lg mt-4 overflow-hidden pb-16">
        <!-- Vehicle image reference -->
        <div class="p-4 bg-gray-50 border-b">
            <div class="flex justify-center">
                <img src="{{ asset('vehicle/5c228ab0874bf47b5d01df12e4caee1c6b30eb24.png') }}"
                     alt="Diagram Kendaraan"
                     class="max-w-full h-auto rounded-lg shadow-sm">
            </div>
        </div>

        <!-- Vehicle inspection parts -->
        <div class="p-4">
            <h2 class="text-lg font-semibold mb-3 text-gray-700">Area Inspeksi</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Front Bumper -->
                <div class="rounded-lg border border-gray-200 overflow-hidden" x-data="{ showUpload: false }">
                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                        <span class="font-medium text-gray-700">Front Bumper</span>
                        <button @click="showUpload = !showUpload" class="text-primary hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-3">
                        <div x-show="showUpload" class="mb-2">
                            <input type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-black hover:file:bg-primary/80" wire:model="frontBumperImage" accept="image/*">
                        </div>
                        <div class="bg-gray-50 rounded flex justify-center">
                            <img src="{{ $images['front_bumper'] ?? asset('vehicle/placeholder.png') }}" alt="Front Bumper" class="max-h-32 rounded">
                        </div>
                    </div>
                </div>

                <!-- Rear Bumper -->
                <div class="rounded-lg border border-gray-200 overflow-hidden" x-data="{ showUpload: false }">
                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                        <span class="font-medium text-gray-700">Rear Bumper</span>
                        <button @click="showUpload = !showUpload" class="text-primary hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-3">
                        <div x-show="showUpload" class="mb-2">
                            <input type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-black hover:file:bg-primary/80" wire:model="rearBumperImage" accept="image/*">
                        </div>
                        <div class="bg-gray-50 rounded flex justify-center">
                            <img src="{{ $images['rear_bumper'] ?? asset('vehicle/placeholder.png') }}" alt="Rear Bumper" class="max-h-32 rounded">
                        </div>
                    </div>
                </div>

                <!-- Hood -->
                <div class="rounded-lg border border-gray-200 overflow-hidden" x-data="{ showUpload: false }">
                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                        <span class="font-medium text-gray-700">Hood</span>
                        <button @click="showUpload = !showUpload" class="text-primary hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-3">
                        <div x-show="showUpload" class="mb-2">
                            <input type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-black hover:file:bg-primary/80" wire:model="hoodImage" accept="image/*">
                        </div>
                        <div class="bg-gray-50 rounded flex justify-center">
                            <img src="{{ $images['hood'] ?? asset('vehicle/placeholder.png') }}" alt="Hood" class="max-h-32 rounded">
                        </div>
                    </div>
                </div>

                <!-- Roof -->
                <div class="rounded-lg border border-gray-200 overflow-hidden" x-data="{ showUpload: false }">
                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                        <span class="font-medium text-gray-700">Roof</span>
                        <button @click="showUpload = !showUpload" class="text-primary hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-3">
                        <div x-show="showUpload" class="mb-2">
                            <input type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-black hover:file:bg-primary/80" wire:model="roofImage" accept="image/*">
                        </div>
                        <div class="bg-gray-50 rounded flex justify-center">
                            <img src="{{ $images['roof'] ?? asset('vehicle/placeholder.png') }}" alt="Roof" class="max-h-32 rounded">
                        </div>
                    </div>
                </div>

                <!-- Left Side -->
                <div class="rounded-lg border border-gray-200 overflow-hidden" x-data="{ showUpload: false }">
                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                        <span class="font-medium text-gray-700">Left Side</span>
                        <button @click="showUpload = !showUpload" class="text-primary hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-3">
                        <div x-show="showUpload" class="mb-2">
                            <input type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-black hover:file:bg-primary/80" wire:model="leftSideImage" accept="image/*">
                        </div>
                        <div class="bg-gray-50 rounded flex justify-center">
                            <img src="{{ $images['left_side'] ?? asset('vehicle/placeholder.png') }}" alt="Left Side" class="max-h-32 rounded">
                        </div>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="rounded-lg border border-gray-200 overflow-hidden" x-data="{ showUpload: false }">
                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                        <span class="font-medium text-gray-700">Right Side</span>
                        <button @click="showUpload = !showUpload" class="text-primary hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-3">
                        <div x-show="showUpload" class="mb-2">
                            <input type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-black hover:file:bg-primary/80" wire:model="rightSideImage" accept="image/*">
                        </div>
                        <div class="bg-gray-50 rounded flex justify-center">
                            <img src="{{ $images['right_side'] ?? asset('vehicle/placeholder.png') }}" alt="Right Side" class="max-h-32 rounded">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes section -->
            <div class="mt-4">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                <textarea id="notes" wire:model="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary" placeholder="Tambahkan catatan tambahan jika ada..."></textarea>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="fixed bottom-16 left-0 right-0 p-4 bg-white border-t shadow-lg">
        <button
            class="w-full py-3 bg-primary text-black font-bold text-center rounded-full shadow-lg hover:bg-primary/90 transition-all transform active:scale-95 flex items-center justify-center"
            wire:click="submitChecklist"
            wire:loading.attr="disabled">
            <span wire:loading.remove>SELESAI</span>
            <span wire:loading>
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                MEMPROSES...
            </span>
        </button>
    </div>

    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>
