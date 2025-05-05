<div class="min-h-screen bg-gray-100 pb-16">
    <!-- Header -->
    <div class="bg-primary text-black p-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold">Paket Pengerjaan</h1>
    </div>

    <div class="p-4 text-sm text-gray-700">
        Pilih Paket Untuk Pengerjaan Mobil Anda
    </div>

    <!-- Filter & Sort -->
    <div class="flex justify-between px-4 py-2">
        <x-ui.filter-button />
        <x-ui.sort-button />
    </div>

    <!-- Paket List -->
    <div class="px-4 py-2 space-y-4">
        @foreach($paketData as $paket)
            <x-ui.card>
                <h3 class="font-semibold text-lg">{{ $paket['name'] }}</h3>
                <p class="text-sm text-gray-600">{{ $paket['description'] }}</p>
                <p class="text-sm font-medium mt-2">{{ $paket['price_range'] }}</p>

                <div class="mt-3 flex space-x-2">
                    @foreach($paket['sizes'] as $size)
                        <button class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium {{ $size === 'M' ? 'bg-primary text-black' : '' }}">
                            {{ $size }}
                        </button>
                    @endforeach
                </div>
            </x-ui.card>
        @endforeach
    </div>

    <!-- Action Button -->
    <div class="fixed bottom-16 left-0 right-0 p-4">
        <x-ui.button color="primary" fullWidth="true">
            SELESAI
        </x-ui.button>
    </div>

    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>