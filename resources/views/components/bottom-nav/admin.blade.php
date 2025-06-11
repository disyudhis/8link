<div x-data="{ showLogoutConfirm: false }" class="flex justify-around items-center h-16 px-3">
    <!-- Dashboard -->
    {{-- <a href="{{ route('admin.antrian') }}"
        class="flex flex-col items-center justify-center w-1/3 h-full {{ request()->routeIs('admin.antrian') ? 'text-primary' : 'text-gray-600' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
        <span class="text-xs">Dashboard</span>
    </a> --}}

    <!-- Antrian -->
    <a href="{{ route('admin.antrian') }}"
        class="flex flex-col items-center justify-center w-1/3 h-full {{ request()->routeIs('admin.antrian') ? 'text-primary' : 'text-gray-600' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
        </svg>
        <span class="text-xs">Antrian</span>
    </a>

    <!-- Logout -->
    <button @click="showLogoutConfirm = true" type="button"
        class="flex flex-col items-center justify-center w-1/3 h-full text-gray-600 focus:outline-none btn-ripple relative overflow-hidden transition-colors duration-200 hover:text-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
        </svg>
        <span class="text-xs">Keluar</span>
    </button>

    @include('components.bottom-nav.logout-modal')
</div>
