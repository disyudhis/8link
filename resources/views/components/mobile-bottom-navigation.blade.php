<div x-data="{ showLogoutConfirm: false }" class="flex justify-around items-center h-16 px-3">
    <!-- Home -->
    <a href="{{ route('home') }}"
        class="flex flex-col items-center justify-center w-1/3 h-full {{ request()->routeIs('home') ? 'text-primary' : 'text-gray-600' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-xs">Home</span>
    </a>

    <!-- Reservasi -->
    <a href="{{ route('reservasi.index') }}"
        class="flex flex-col items-center justify-center w-1/3 h-full {{ request()->routeIs('reservasi.*') ? 'text-primary' : 'text-gray-600' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <span class="text-xs">Antrian Saya</span>
    </a>

    <!-- Logout - Ubah menjadi button dengan animasi ripple -->
    <button @click="showLogoutConfirm = true" type="button"
        class="flex flex-col items-center justify-center w-1/3 h-full text-gray-600 focus:outline-none btn-ripple relative overflow-hidden transition-colors duration-200 hover:text-primary">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
            </svg>
            <span class="text-xs mt-1 transition-all duration-300">Log out</span>

            <!-- Indicator dot untuk efek klik -->
            <span class="absolute -top-1 -right-1 h-2 w-2 bg-transparent rounded-full transform scale-0 transition-transform duration-300 origin-center"
                  :class="{'scale-100 bg-red-500': showLogoutConfirm}"></span>
        </div>
    </button>

    <!-- Modal Konfirmasi Logout -->
    <!-- Modal Konfirmasi Logout dengan animasi yang lebih baik -->
    <div x-show="showLogoutConfirm"
         x-cloak
         @keydown.escape.window="showLogoutConfirm = false"
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay dengan animasi fade -->
            <div x-show="showLogoutConfirm"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                 aria-hidden="true"></div>

            <!-- Modal position trick -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel dengan animasi slide dan zoom -->
            <div x-show="showLogoutConfirm"
                 @click.away="showLogoutConfirm = false"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 px-4 pt-5 pb-4">

                <div class="sm:flex sm:items-start">
                    <!-- Icon Alert -->
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Konfirmasi Logout
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Apakah Anda yakin ingin keluar dari aplikasi? Sesi Anda akan berakhir.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                            Logout
                        </button>
                    </form>
                    <button @click="showLogoutConfirm = false"
                            type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition-colors duration-200">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan style Alpine.js untuk animasi modal -->
<style>
    [x-cloak] { display: none !important; }

    /* Tambahan style untuk animasi yang lebih halus */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Efek ripple untuk tombol */
    .btn-ripple {
        position: relative;
        overflow: hidden;
    }

    .btn-ripple:after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }

    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(100, 100);
            opacity: 0;
        }
    }

    .btn-ripple:focus:not(:active)::after {
        animation: ripple 1s ease-out;
    }
</style>