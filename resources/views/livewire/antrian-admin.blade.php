<div class="p-4 space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
        <p class="text-gray-600">Kelola antrian dan reservasi perbaikan cat kendaraan</p>
    </div>

    <!-- Status Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-600 text-sm font-medium">Pending</p>
                    <p class="text-2xl font-bold text-yellow-700">{{ $statusCounts['pending'] }}</p>
                </div>
                <div class="w-8 h-8 bg-yellow-200 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-600 text-sm font-medium">Confirmed</p>
                    <p class="text-2xl font-bold text-blue-700">{{ $statusCounts['confirmed'] }}</p>
                </div>
                <div class="w-8 h-8 bg-blue-200 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-600 text-sm font-medium">In Progress</p>
                    <p class="text-2xl font-bold text-green-700">{{ $statusCounts['in_progress'] }}</p>
                </div>
                <div class="w-8 h-8 bg-green-200 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Completed</p>
                    <p class="text-2xl font-bold text-gray-700">{{ $statusCounts['completed'] }}</p>
                </div>
                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-600 text-sm font-medium">Cancelled</p>
                    <p class="text-2xl font-bold text-red-700">{{ $statusCounts['cancelled'] }}</p>
                </div>
                <div class="w-8 h-8 bg-red-200 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model.live="selectedStatus"
                        class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                    <input wire:model.live="search" type="text"
                        placeholder="Cari plat nomor, nama mobil, atau customer..."
                        class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                </div>
            </div>
            <div class="text-sm text-gray-500">
                Total: {{ $bookings->total() }} booking
            </div>
        </div>
    </div>

    <!-- Bookings List -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        @if ($bookings->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach ($bookings as $booking)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div class="flex-1 space-y-3">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $booking->status_color }}">
                                        {{ $booking->status_text }}
                                    </span>
                                    @if ($booking->queue_number)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Antrian #{{ $booking->queue_number }}
                                        </span>
                                    @endif
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $booking->car_name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $booking->license_plate }} •
                                            {{ $booking->car_color }}</p>
                                        <p class="text-sm text-gray-600">Customer:
                                            {{ $booking->customer->name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Tanggal Booking:
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-600">Paket:
                                            {{ $booking->packagePrice->name ?? 'N/A' }}</p>
                                        <p class="text-sm font-semibold text-gray-900">Total: Rp
                                            {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                @if ($booking->notes)
                                    <div class="bg-gray-50 rounded-md p-3">
                                        <p class="text-sm text-gray-700"><strong>Catatan:</strong>
                                            {{ $booking->notes }}</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Improved Action Buttons Section -->
                            <div class="flex flex-col sm:flex-row lg:flex-col gap-2 lg:min-w-[140px]">
                                <!-- Detail Button - Always visible -->
                                <a href="{{ route('admin.reservasi.show', ['id' => $booking->id]) }}"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-blue-300 text-sm font-medium rounded-lg text-blue-700 bg-blue-50 hover:bg-blue-100 hover:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada booking</h3>
                <p class="mt-1 text-sm text-gray-500">Belum ada booking yang sesuai dengan filter yang dipilih.</p>
            </div>
        @endif
    </div>



    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>

@push('script')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('booking-confirmed', (event) => {
                alert(event.message);
            });

            Livewire.on('booking-cancelled', (event) => {
                alert(event.message);
            });

            Livewire.on('booking-started', (event) => {
                alert(event.message);
            });

            Livewire.on('booking-completed', (event) => {
                alert(event.message);
            });
        });
    </script>
@endpush
