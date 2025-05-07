<div x-data="{ activeTab: 'layanan' }" class="bg-gray-50 pb-16">
    <!-- Hero Section -->
    <div class="bg-primary pt-6 pb-12 rounded-b-xl shadow-sm">
        <!-- Content -->
        <div class="px-4">
            <h1 class="text-black text-2xl font-bold">Blink Autoshine</h1>
            <p class="text-black text-sm">Layanan perbaikan mobil tepercaya</p>

            <!-- Search Bar -->
            <div class="mt-4 relative">
                <input type="text" placeholder="Cari layanan atau sparepart..."
                    class="w-full py-2 pl-10 pr-4 rounded-lg bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm">
                <div class="absolute left-3 top-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Card -->
    <div class="px-4 -mt-6">
        <div class="bg-white rounded-lg p-3 shadow flex justify-between items-center">
            <div class="text-center">
                <span class="block text-lg font-bold text-gray-800">{{ \Carbon\Carbon::now()->format('d') }}</span>
                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->format('M') }}</span>
            </div>
            <div class="text-center border-l border-r px-4 border-gray-100">
                <span class="block text-lg font-bold text-gray-800">24/7</span>
                <span class="text-xs text-gray-500">Layanan</span>
            </div>
            <div class="text-center">
                <span class="block text-lg font-bold text-gray-800">4.9<span class="text-sm">★</span></span>
                <span class="text-xs text-gray-500">Rating</span>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="px-4 mt-4 mb-4">
        <div class="flex bg-gray-100 p-1 rounded-lg">
            <button @click="activeTab = 'layanan'"
                :class="{ 'bg-white shadow text-yellow-500': activeTab === 'layanan', 'text-gray-500': activeTab !== 'layanan' }"
                class="flex-1 py-2 rounded-lg text-sm transition-all duration-200">
                Layanan
            </button>
            <button @click="activeTab = 'antrian'"
                :class="{ 'bg-white shadow text-yellow-500': activeTab === 'antrian', 'text-gray-500': activeTab !== 'antrian' }"
                class="flex-1 py-2 rounded-lg text-sm transition-all duration-200">
                Antrian Saya
            </button>
        </div>
    </div>

    <!-- Tab Content - Layanan -->
    <div x-show="activeTab === 'layanan'" class="px-4 space-y-4">
        <!-- Paket Pengerjaan Card -->
        <a href="{{ route('paket-pengerjaan') }}" class="block">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary text-black p-4 flex items-center justify-center w-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="p-4 flex-grow">
                        <h3 class="font-semibold text-gray-800">Paket Pengerjaan</h3>
                        <p class="text-xs text-gray-600 mt-1">Pilih paket servis sesuai kebutuhan kendaraan Anda</p>
                    </div>
                    <div class="flex items-center pr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>

        <!-- Promo Section -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-semibold text-gray-800 mb-3">Promo Spesial</h3>
            <div class="overflow-x-auto flex space-x-3 pb-2">
                <!-- Promo Card 1 -->
                <div class="flex-shrink-0 w-56 bg-primary rounded-lg overflow-hidden">
                    <div class="p-3 text-black">
                        <h4 class="font-bold">Service Berkala</h4>
                        <p class="text-xs mt-1 text-black">Perawatan rutin kendaraan</p>
                        <div class="mt-2 flex items-center">
                            <span class="line-through text-black text-xs">Rp. 800.000</span>
                            <span class="font-bold ml-2">Rp. 560.000</span>
                        </div>
                        <button class="mt-2 bg-white text-black text-xs font-medium py-1 px-3 rounded">Lihat
                            Detail</button>
                    </div>
                </div>

                <!-- Promo Card 2 -->
                <div class="flex-shrink-0 w-56 bg-gray-800 rounded-lg overflow-hidden">
                    <div class="p-3 text-white">
                        <h4 class="font-bold">Ganti Oli Premium</h4>
                        <p class="text-xs mt-1 text-gray-300">Oli berkualitas</p>
                        <div class="mt-2 flex items-center">
                            <span class="line-through text-gray-400 text-xs">Rp. 350.000</span>
                            <span class="font-bold ml-2">Rp. 297.500</span>
                        </div>
                        <button class="mt-2 bg-primary text-black text-xs font-medium py-1 px-3 rounded">Lihat
                            Detail</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Layanan Populer -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-semibold text-gray-800 mb-3">Layanan Populer</h3>
            <div class="grid grid-cols-3 gap-3">
                <!-- Layanan 1 -->
                <div class="text-center">
                    <div class="bg-yellow-100 rounded-lg h-12 w-12 mx-auto flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mt-1 text-gray-700">Tune Up</p>
                </div>

                <!-- Layanan 2 -->
                <div class="text-center">
                    <div class="bg-yellow-100 rounded-lg h-12 w-12 mx-auto flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mt-1 text-gray-700">Asuransi</p>
                </div>

                <!-- Layanan 3 -->
                <div class="text-center">
                    <div class="bg-yellow-100 rounded-lg h-12 w-12 mx-auto flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mt-1 text-gray-700">Diagnosa</p>
                </div>

                <!-- Layanan 4 -->
                <div class="text-center">
                    <div class="bg-yellow-100 rounded-lg h-12 w-12 mx-auto flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mt-1 text-gray-700">Darurat</p>
                </div>

                <!-- Layanan 5 -->
                <div class="text-center">
                    <div class="bg-yellow-100 rounded-lg h-12 w-12 mx-auto flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mt-1 text-gray-700">Spare Part</p>
                </div>

                <!-- Layanan 6 -->
                <div class="text-center">
                    <div class="bg-yellow-100 rounded-lg h-12 w-12 mx-auto flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mt-1 text-gray-700">Garansi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Content - Antrian Saya -->
    <div x-show="activeTab === 'antrian'" class="px-4">
        <!-- Loading state -->
        <div wire:loading.delay class="bg-white rounded-lg shadow-sm p-6 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-yellow-500 mx-auto"></div>
            <p class="text-sm text-gray-600 mt-3">Memuat data antrian...</p>
        </div>

        <!-- Bookings List -->
        <div wire:loading.remove>
            @if (count($bookings) > 0)
                <h3 class="font-semibold text-gray-800 mb-3">Antrian Aktif Anda</h3>

                @foreach ($bookings as $booking)
                    <div class="bg-white rounded-lg shadow-sm mb-3 overflow-hidden">
                        <!-- Header with status indicator -->
                        <div
                            class="border-l-4 px-4 py-3
                            @if ($booking->status == 'pending') border-yellow-500
                            @elseif($booking->status == 'processing') border-blue-500
                            @elseif($booking->status == 'completed') border-green-500
                            @elseif($booking->status == 'cancelled') border-red-500 @endif">
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold text-gray-800">{{ $booking->car_name }}</h4>
                                <span
                                    class="text-xs px-2 py-1 rounded-full
                                    @if ($booking->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($booking->status == 'processing') bg-blue-100 text-blue-700
                                    @elseif($booking->status == 'completed') bg-green-100 text-green-700
                                    @elseif($booking->status == 'cancelled') bg-red-100 text-red-700 @endif">
                                    {{ $statusLabels[$booking->status] }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ $booking->license_plate }} •
                                {{ $booking->car_color }}</p>
                        </div>

                        <!-- Booking Details -->
                        <div class="px-4 py-3 border-t border-gray-100">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">{{ $this->formatDate($booking->booking_date) }}</span>
                            </div>

                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span
                                    class="text-sm">{{ $booking->packagePrice ? $booking->packagePrice->servicePackage->name : 'Paket Tidak Tersedia' }}</span>
                            </div>

                            <div class="flex items-center">
                                Rp.
                                <span class="text-sm">{{ number_format($booking->total_price, 0, ',', '.') }}K</span>
                            </div>
                        </div>

                        <!-- Notes if available -->
                        @if ($booking->notes)
                            <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
                                <p class="text-xs text-gray-600">{{ $booking->notes }}</p>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="px-4 py-3 border-t border-gray-100 flex justify-between">
                            {{-- @if ($booking->status === 'pending')
                                <button wire:click="cancelBooking({{ $booking->id }})" wire:loading.attr="disabled"
                                    class="text-xs font-medium text-red-600 hover:text-red-800">
                                    Batalkan
                                </button>
                            @else
                                <span></span>
                            @endif --}}
                            <a href="{{ route('reservasi.show', $booking->id) }}"
                                class="text-xs font-medium text-yellow-600 hover:text-yellow-800">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- No bookings state -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <div class="bg-yellow-100 rounded-full h-14 w-14 mx-auto flex items-center justify-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Belum Ada Antrian Aktif</h3>
                    <p class="text-sm text-gray-600 mb-4">Anda belum memiliki reservasi layanan aktif saat ini.</p>
                    <a href="{{ route('paket-pengerjaan') }}"
                        class="inline-block bg-primary text-black text-sm font-medium px-4 py-2 rounded-lg">
                        Buat Reservasi
                    </a>
                </div>
            @endif
        </div>

        <!-- Toast Notification Script -->
        @push('script')
            <script>
                document.addEventListener('show-message', event => {
                    Swal.fire({
                        icon: event.detail.type,
                        title: event.detail.type === 'success' ? 'Berhasil!' : 'Oops!',
                        text: event.detail.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            </script>
        @endpush
    </div>

    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>
