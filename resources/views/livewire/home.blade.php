<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-primary text-black p-4">
        <h1 class="text-xl font-semibold">Home</h1>
        <p class="text-sm opacity-90">Hi Teman! Selamat datang di Wash Anda</p>
    </div>

    <!-- Main Content -->
    <div class="px-4 py-6 space-y-4">
        <!-- Checklist Kendaraan -->
        {{-- <a href="{{ route('detail-kendaraan') }}" class="block">
            <div class="bg-primary text-black rounded-lg p-4 text-center">
                <h2 class="font-semibold text-lg">CHECKLIST KENDARAAN</h2>
            </div>
        </a> --}}

        <!-- Paket Pengerjaan -->
        <a href="{{ route('paket-pengerjaan') }}" class="block">
            <div class="bg-primary text-black rounded-lg p-4 text-center">
                <h2 class="font-semibold text-lg">PAKET PENGERJAAN</h2>
            </div>
        </a>

        <!-- Informasi Kendaraan -->
        {{-- <a href="{{ route('informasi-kendaraan') }}" class="block">
            <div class="bg-primary text-white rounded-lg p-4 text-center">
                <h2 class="font-semibold text-lg">INFORMASI KENDARAAN</h2>
            </div>
        </a> --}}
    </div>

    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>