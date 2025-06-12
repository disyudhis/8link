<div class="min-h-screen bg-gray-50">
    <!-- Header with Back Button -->
    <div class="bg-white shadow-sm border-b">
        <div class="px-4 py-4">
            <div class="flex items-center space-x-3">
                <button onclick="history.back()" class="p-2 -ml-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <div>
                    <h1 class="text-lg font-semibold text-gray-900">Detail Booking</h1>
                    <p class="text-sm text-gray-500">#{{ $booking->queue_number }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mx-4 mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <p class="text-green-700 text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Status Badge -->
    <div class="px-4 py-4">
        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $booking->status_color }}">
            <div class="w-2 h-2 rounded-full bg-current mr-2"></div>
            {{ $booking->status_text }}
        </div>
    </div>

    <!-- Vehicle Information -->
    <div class="mx-4 mb-4 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z">
                        </path>
                        <path
                            d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z">
                        </path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $booking->car_name }}</h3>
                    <div class="mt-2 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Plat Nomor</span>
                            <span class="text-sm font-medium text-gray-900">{{ $booking->license_plate }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Warna</span>
                            <span class="text-sm font-medium text-gray-900">{{ $booking->car_color }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Tanggal Booking</span>
                            <span
                                class="text-sm font-medium text-gray-900">{{ $booking->booking_date->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Information -->
    <div class="mx-4 mb-4 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $booking->customer->name }}</h3>
                    <div class="mt-2 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Email</span>
                            <span class="text-sm font-medium text-gray-900">{{ $booking->customer->email }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Telepon</span>
                            <span
                                class="text-sm font-medium text-gray-900">{{ $booking->customer->phone ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Package -->
    <div class="mx-4 mb-4 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $booking->packagePrice->servicePackage->name }}
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $booking->packagePrice->servicePackage->description }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm text-gray-500">Kategori Kendaraan</span>
                        <span
                            class="text-sm font-medium text-gray-900">{{ $booking->packagePrice->carCategory->name }}</span>
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-sm text-gray-500">Harga Total</span>
                        <span class="text-lg font-bold text-green-600">Rp
                            {{ number_format($booking->total_price, 0, ',', '.') }}K</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes -->
    @if ($booking->notes)
        <div class="mx-4 mb-4 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Catatan</h3>
                <p class="text-gray-700">{{ $booking->notes }}</p>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="px-4 pb-8 space-y-3">
        @if ($booking->status === 'pending')
            <button wire:click="openAssignModal"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-4 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                    </path>
                </svg>
                <span>Assign Pekerja & Konfirmasi</span>
            </button>
        @elseif($booking->status === 'confirmed')
            <button wire:click="startProgress"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-4 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span>Mulai Pengerjaan</span>
            </button>
        @endif
    </div>

    <!-- Assign Worker Modal -->
    @if ($showAssignModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-end sm:items-center justify-center">
            <div class="bg-white w-full max-w-md mx-4 rounded-t-3xl sm:rounded-xl max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Assign Pekerja</h3>
                    <button wire:click="closeAssignModal" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6 overflow-y-auto max-h-96">
                    <!-- RFID Section -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Scan RFID Pekerja</h4>
                        <div class="space-y-3">
                            @if (!$rfidReading)
                                <button wire:click="startRfidReading"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z">
                                        </path>
                                    </svg>
                                    <span>Mulai Scan RFID</span>
                                </button>
                            @else
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600">
                                        </div>
                                        <div>
                                            <p class="text-blue-800 font-medium">Menunggu scan RFID...</p>
                                            <p class="text-blue-600 text-sm">Tempelkan kartu RFID pekerja</p>
                                        </div>
                                    </div>
                                    <button wire:click="stopRfidReading"
                                        class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        Batalkan
                                    </button>
                                </div>
                            @endif

                            @if ($assignedWorker)
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-green-800 font-medium">{{ $assignedWorker->name }}</p>
                                            <p class="text-green-600 text-sm">
                                                {{ $assignedWorker->specialization ?? 'Pekerja' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (session()->has('rfid-error'))
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                    <p class="text-red-800 text-sm">{{ session('rfid-error') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">atau pilih manual</span>
                        </div>
                    </div>

                    <!-- Manual Worker Selection -->
                    <div>
                        <h4 class="font-medium text-gray-900 mb-3">Pilih Pekerja</h4>
                        <div class="space-y-2 max-h-40 overflow-y-auto">
                            @foreach ($workers as $worker)
                                <div class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors {{ $selectedWorker == $worker->id ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}"
                                    wire:click="$set('selectedWorker', {{ $worker->id }})">
                                    <input type="radio" name="worker" value="{{ $worker->id }}"
                                        {{ $selectedWorker == $worker->id ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">{{ $worker->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $worker->specialization ?? 'Pekerja' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="border-t p-6">
                    <div class="flex space-x-3">
                        <button wire:click="closeAssignModal"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                            Batal
                        </button>
                        <button wire:click="assignWorker" {{ !$selectedWorker ? 'disabled' : '' }}
                            class="flex-1 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                            Assign & Konfirmasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>

@push('script')
    <script>
        // RFID Reading Simulation
        let rfidInterval;

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('start-rfid-reading', () => {
                console.log('Starting RFID reading...');

                // Simulate RFID reading after 3 seconds for demo
                setTimeout(() => {
                    // Simulate random RFID data
                    const simulatedRfidData = 'RFID_' + Math.random().toString(36).substr(2, 9);
                    Livewire.dispatch('rfid-detected', {
                        rfidData: simulatedRfidData
                    });
                }, 3000);

                // In real implementation, you would integrate with actual RFID reader
                // Example using Web Serial API or WebUSB for RFID readers
            });

            Livewire.on('stop-rfid-reading', () => {
                console.log('Stopping RFID reading...');
                if (rfidInterval) {
                    clearInterval(rfidInterval);
                }
            });
        });

        // Real RFID Implementation Example (uncomment when ready to use real RFID)
        /*
        async function initRFIDReader() {
            try {
                // Request serial port access
                const port = await navigator.serial.requestPort();
                await port.open({ baudRate: 9600 });

                const reader = port.readable.getReader();

                while (true) {
                    const { value, done } = await reader.read();
                    if (done) break;

                    // Parse RFID data from serial input
                    const rfidData = new TextDecoder().decode(value).trim();
                    if (rfidData) {
                        Livewire.dispatch('rfid-detected', { rfidData: rfidData });
                    }
                }
            } catch (error) {
                console.error('RFID Reader Error:', error);
            }
        }
        */
    </script>
@endpush
