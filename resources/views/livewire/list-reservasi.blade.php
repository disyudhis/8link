<div class="bg-white rounded-lg shadow-md p-4">
    <!-- Header dengan desain minimalis -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-gray-800">Daftar Reservasi</h2>
        <a href="{{ route('user.paket-pengerjaan') }}" class="bg-primary hover:bg-secondnary text-black px-3 py-1.5 rounded-md text-sm flex items-center">
            <x-icon.plus :size="4" class="mr-1" />
            Tambah
        </a>
    </div>

    <!-- Pencarian dengan filter yang lebih ringkas -->
    <div class="mb-4">
        <div class="flex gap-2">
            <div class="flex-1">
                <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-icon.search :size="4" class="text-gray-400" />
                    </div>
                    <input
                        wire:model.debounce.300ms="search"
                        type="text"
                        placeholder="Cari reservasi..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 text-sm"
                    >
                </div>
            </div>
            <div>
                <select
                    wire:model="status"
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 text-sm"
                >
                    <option value="">Status</option>
                    <option value="pending">Menunggu</option>
                    <option value="confirmed">Terkonfirmasi</option>
                    <option value="in_progress">Proses</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Batal</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Daftar reservasi dalam bentuk kartu untuk mobile -->
    <div class="space-y-3" x-data="{ selectedBooking: null }">
        @forelse($bookings as $booking)
            <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <div class="p-3 bg-gray-50 flex justify-between items-center">
                    <div class="font-medium text-sm">
                        #{{ $booking->id }} · {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                    </div>
                    <x-status-badge :status="$booking->status" />
                </div>

                <div class="p-3">
                    <div class="flex justify-between mb-2">
                        <div>
                            <div class="font-medium">{{ $booking->customer->name }}</div>
                            <div class="text-xs text-gray-500">{{ $booking->customer->phone }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-yellow-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <div class="flex justify-between text-sm">
                        <div>
                            <div class="font-medium">{{ $booking->car_name }}</div>
                            <div class="text-xs text-gray-500">{{ $booking->license_plate }} · {{ $booking->car_color }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">Paket:</div>
                            <div>{{ $booking->packagePrice->servicePackage->name }}</div>
                        </div>
                    </div>
                </div>

                <div class="px-3 py-2 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-end">
                        <a href="{{ route('user.reservasi.show', $booking) }}" class="inline-flex items-center px-3 py-1 text-xs bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100">
                            <x-icon.eye :size="4" class="mr-1" />
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <x-empty-state
                message="Tidak ada reservasi ditemukan"
                icon="calendar"
                actionText="Tambah Reservasi Baru"
                actionUrl="{{ route('user.paket-pengerjaan') }}"
            />

        @endforelse
    </div>

    <!-- Pagination yang mobile-friendly -->
    <div class="mt-4 flex justify-center">
        {{ $bookings->links('vendor.livewire.simple-tailwind') }}
    </div>


    <!-- Bottom Navigation -->
    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>
