{{-- Belum Diperbaiki --}}
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

    @if ($booking->assignedWorker)
        <div class="mx-4 mb-4 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $booking->assignedWorker->name }}</h3>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                <span class="text-sm text-green-600 font-medium">Assigned</span>
                            </div>
                        </div>

                        <div class="mt-2 space-y-2">
                            @if ($booking->assignedWorker->phone)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Telepon</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $booking->assignedWorker->phone }}</span>
                                </div>
                            @endif

                            @if ($booking->assigned_at)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Assigned At</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $booking->updated_at->format('d M Y, H:i') }}</span>
                                </div>
                            @endif

                            @if ($booking->completed_at)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Diselesaikan</span>
                                    <span
                                        class="text-sm font-medium text-green-700">{{ $booking->completed_at->format('d M Y, H:i') }}</span>
                                </div>
                                @if ($booking->duration)
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">Total Durasi</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $booking->duration }}</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
                    <p class="text-sm text-gray-500 mt-1">{{ $booking->packagePrice->servicePackage->description }}
                    </p>
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
        @elseif($booking->status === 'in_progress')
            <button wire:click="openCompleteModal"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-4 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span>Selesaikan Pekerjaan</span>
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
                                <button wire:click="startRfidReading" wire:ignore
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

    <!-- Complete Work Modal -->
    @if ($showCompleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-end sm:items-center justify-center">
            <div class="bg-white w-full max-w-md mx-4 rounded-t-3xl sm:rounded-xl max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Selesaikan Pekerjaan</h3>
                    <button wire:click="closeCompleteModal"
                        class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6">
                    <!-- Booking Info -->
                    <div class="mb-6 bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">
                                    {{ $booking->packagePrice->servicePackage->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $booking->car_name }} -
                                    {{ $booking->license_plate }}</p>
                            </div>
                        </div>

                        @if ($booking->assignedWorker)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Pekerja:</span>
                                <span class="font-medium text-gray-900">{{ $booking->assignedWorker->name }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Completion Notes -->
                    <div class="mb-6">
                        <label for="completionNotes" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan Penyelesaian (Opsional)
                        </label>
                        <textarea wire:model="completionNotes" id="completionNotes" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none"
                            placeholder="Tambahkan catatan atau keterangan tambahan untuk penyelesaian pekerjaan ini..."></textarea>
                    </div>

                    <!-- Confirmation -->
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h5 class="text-sm font-medium text-green-800">Konfirmasi Penyelesaian</h5>
                                <p class="text-sm text-green-700 mt-1">
                                    Pastikan semua pekerjaan telah selesai dikerjakan sesuai dengan paket layanan yang
                                    dipilih.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="border-t p-6">
                    <div class="flex space-x-3">
                        <button wire:click="closeCompleteModal"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                            Batal
                        </button>
                        <button wire:click="completeWork"
                            class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Selesaikan Pekerjaan</span>
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
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-database-compat.js"></script>

    <script>
        // Firebase Configuration
        const firebaseConfig = {
            apiKey: "AIzaSyD5JAXdJRTe5yhPUhKFsgXmljPngM6jkMs",
            authDomain: "blink-reservation.firebaseapp.com",
            databaseURL: "https://blink-reservation-default-rtdb.asia-southeast1.firebasedatabase.app/",
            projectId: "blink-reservation",
            storageBucket: "blink-reservation.firebasestorage.app",
            messagingSenderId: "577448432865",
            appId: "1:577448432865:web:452f3ecb25c0825e4d93a0"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const database = firebase.database();

        class RfidManager {
            constructor() {
                this.isListening = false;
                this.listener = null;
                this.timeoutHandler = null;
                this.lastProcessedTimestamp = null;
            }

            startListening() {
                if (this.isListening) {
                    console.log('Already listening for RFID scans');
                    return;
                }

                this.isListening = true;
                console.log('Starting RFID listening...');

                // Listen to the latest RFID scan
                this.listener = database.ref('rfid_scans/latest').on('value', (snapshot) => {
                    const scanData = snapshot.val();

                    if (scanData && this.shouldProcessScan(scanData)) {
                        console.log('New RFID scan detected:', scanData);
                        this.processScan(scanData);
                    }
                });

                // Also listen to new scans by timestamp
                const currentTime = Date.now();
                database.ref('rfid_scans')
                    .orderByKey()
                    .startAt(currentTime.toString())
                    .on('child_added', (snapshot) => {
                        const scanData = snapshot.val();
                        const timestamp = snapshot.key;

                        if (scanData && timestamp !== 'latest' && this.shouldProcessScan(scanData)) {
                            console.log('New timestamped RFID scan:', scanData);
                            this.processScan(scanData);
                        }
                    });
            }

            stopListening() {
                if (!this.isListening) {
                    return;
                }

                this.isListening = false;
                console.log('Stopping RFID listening...');

                if (this.listener) {
                    database.ref('rfid_scans/latest').off('value', this.listener);
                    database.ref('rfid_scans').off('child_added');
                    this.listener = null;
                }

                this.clearTimeout();
            }

            shouldProcessScan(scanData) {
                // Don't process if already processed
                if (scanData.processed) {
                    return false;
                }

                // Don't process if we've already processed this timestamp
                if (this.lastProcessedTimestamp === scanData.timestamp) {
                    return false;
                }

                // Don't process old scans (older than 5 seconds)
                const currentTime = Date.now();
                const scanTime = parseInt(scanData.timestamp);
                if (currentTime - scanTime > 5000) {
                    console.log('Ignoring old scan:', scanData);
                    return false;
                }

                return true;
            }

            processScan(scanData) {
                this.lastProcessedTimestamp = scanData.timestamp;

                // Dispatch to Livewire dengan format yang benar
                Livewire.dispatch('rfid-detected', {
                    card_uid: scanData.card_uid,
                    timestamp: scanData.timestamp,
                    device_id: scanData.device_id || 'ESP32_RFID_STATION_01'
                });

                // Stop listening after successful scan
                this.stopListening();
            }

            setTimeout(timeout) {
                this.clearTimeout();

                this.timeoutHandler = setTimeout(() => {
                    console.log('RFID scan timeout');
                    this.stopListening();
                    Livewire.dispatch('rfid-timeout');
                }, timeout);
            }

            clearTimeout() {
                if (this.timeoutHandler) {
                    clearTimeout(this.timeoutHandler);
                    this.timeoutHandler = null;
                }
            }
        }

        // Initialize RFID Manager
        const rfidManager = new RfidManager();

        // Livewire Event Listeners
        document.addEventListener('livewire:initialized', () => {
            // Listen for start RFID reading command
            Livewire.on('start-rfid-listening', () => {
                rfidManager.startListening();
            });

            // Listen for stop RFID reading command
            Livewire.on('stop-rfid-listening', () => {
                rfidManager.stopListening();
            });

            // Listen for timeout setting
            Livewire.on('set-rfid-timeout', (event) => {
                rfidManager.setTimeout(event.timeout || 30000);
            });
        });

        // Cleanup when page unloads
        window.addEventListener('beforeunload', () => {
            rfidManager.stopListening();
        });

        // Connection status monitoring
        database.ref('.info/connected').on('value', (snapshot) => {
            const connected = snapshot.val();
            console.log('Firebase connection status:', connected ? 'Connected' : 'Disconnected');

            if (!connected && rfidManager.isListening) {
                console.log('Firebase disconnected, stopping RFID listening');
                rfidManager.stopListening();
                Livewire.dispatch('rfid-error', {
                    message: 'Connection lost. Please try again.'
                });
            }
        });

        // Device status monitoring
        function checkDeviceStatus() {
            database.ref('devices/ESP32_RFID_STATION_01').once('value')
                .then((snapshot) => {
                    const device = snapshot.val();
                    if (device) {
                        const lastSeen = device.last_seen;
                        const currentTime = Date.now();
                        const isOnline = (currentTime - lastSeen) < 30000; // 30 seconds threshold

                        console.log('Device status:', isOnline ? 'Online' : 'Offline');

                        // You can dispatch this to Livewire if needed
                        Livewire.dispatch('device-status-changed', {
                            status: isOnline ? 'online' : 'offline'
                        });
                    }
                })
                .catch((error) => {
                    console.error('Error checking device status:', error);
                });
        }

        // Check device status periodically
        setInterval(checkDeviceStatus, 10000); // Every 10 seconds

        // Error handling for Firebase
        database.ref().on('error', (error) => {
            console.error('Firebase error:', error);
            if (rfidManager.isListening) {
                rfidManager.stopListening();
                Livewire.dispatch('rfid-error', {
                    message: 'Database error. Please try again.'
                });
            }
        });
    </script>
@endpush
