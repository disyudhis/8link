<div x-data="{ showLogoutConfirm: false }" class="flex justify-around items-center h-16 px-3">
    <!-- Home -->
    <a href="{{ route('user.home') }}"
        class="flex flex-col items-center justify-center w-1/4 h-full {{ request()->routeIs('user.home') ? 'text-primary' : 'text-gray-600' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-xs">Home</span>
    </a>

    <!-- Paket -->
    <a href="{{ route('user.paket-pengerjaan') }}"
        class="flex flex-col items-center justify-center w-1/4 h-full {{ request()->routeIs('user.paket-pengerjaan') ? 'text-primary' : 'text-gray-600' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
        <span class="text-xs">Paket</span>
    </a>

    <!-- Reservasi -->
    <a href="{{ route('user.reservasi.index') }}"
        class="flex flex-col items-center justify-center w-1/4 h-full {{ request()->routeIs('user.reservasi.*') ? 'text-primary' : 'text-gray-600' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <span class="text-xs">Antrian Saya</span>
    </a>

    <!-- Logout -->
    <button @click="showLogoutConfirm = true" type="button"
        class="flex flex-col items-center justify-center w-1/4 h-full text-gray-600 focus:outline-none btn-ripple relative overflow-hidden transition-colors duration-200 hover:text-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
        </svg>
        <span class="text-xs">Keluar</span>
    </button>

    @include('components.bottom-nav.logout-modal')
</div>
