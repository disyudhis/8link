<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 space-y-6">
    <!-- Modern Header with Gradient -->
    <div
        class="relative overflow-hidden bg-gradient-to-r from-yellow-300 via-yellow-400 to-yellow-700 rounded-2xl shadow-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-2">Dashboard Admin</h1>
                    <p class="text-blue-100 text-sm md:text-base">Kelola antrian dan reservasi perbaikan cat kendaraan
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quick Stats in Header -->
            <div class="flex items-center space-x-4 text-sm">
                <div class="flex items-center space-x-1">
                    <div class="w-2 h-2 bg-yellow-300 rounded-full animate-pulse"></div>
                    <span>{{ $statusCounts['pending'] }} Pending</span>
                </div>
                <div class="flex items-center space-x-1">
                    <div class="w-2 h-2 bg-green-300 rounded-full"></div>
                    <span>{{ $statusCounts['in_progress'] }} Aktif</span>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
    </div>

    <!-- Modern Status Cards Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 md:gap-4">
        <!-- Pending Card -->
        <div
            class="group relative overflow-hidden bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-yellow-100 hover:border-yellow-200">
            <div class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-amber-50 opacity-50"></div>
            <div class="relative p-4 md:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $statusCounts['pending'] }}</p>
                        <p class="text-yellow-600 text-xs md:text-sm font-medium">Pending</p>
                    </div>
                </div>
                <div class="w-full bg-yellow-100 rounded-full h-1.5">
                    <div class="bg-gradient-to-r from-yellow-400 to-amber-500 h-1.5 rounded-full transition-all duration-1000"
                        style="width: {{ $statusCounts['pending'] > 0 ? min(($statusCounts['pending'] / max(array_sum($statusCounts), 1)) * 100, 100) : 0 }}%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmed Card -->
        <div
            class="group relative overflow-hidden bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-blue-100 hover:border-blue-200">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-cyan-50 opacity-50"></div>
            <div class="relative p-4 md:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $statusCounts['confirmed'] }}</p>
                        <p class="text-blue-600 text-xs md:text-sm font-medium">Confirmed</p>
                    </div>
                </div>
                <div class="w-full bg-blue-100 rounded-full h-1.5">
                    <div class="bg-gradient-to-r from-blue-400 to-cyan-500 h-1.5 rounded-full transition-all duration-1000"
                        style="width: {{ $statusCounts['confirmed'] > 0 ? min(($statusCounts['confirmed'] / max(array_sum($statusCounts), 1)) * 100, 100) : 0 }}%">
                    </div>
                </div>
            </div>
        </div>

        <!-- In Progress Card -->
        <div
            class="group relative overflow-hidden bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-green-100 hover:border-green-200">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"></div>
            <div class="relative p-4 md:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white animate-spin" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $statusCounts['in_progress'] }}</p>
                        <p class="text-green-600 text-xs md:text-sm font-medium">In Progress</p>
                    </div>
                </div>
                <div class="w-full bg-green-100 rounded-full h-1.5">
                    <div class="bg-gradient-to-r from-green-400 to-emerald-500 h-1.5 rounded-full transition-all duration-1000"
                        style="width: {{ $statusCounts['in_progress'] > 0 ? min(($statusCounts['in_progress'] / max(array_sum($statusCounts), 1)) * 100, 100) : 0 }}%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Card -->
        <div
            class="group relative overflow-hidden bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-gray-200">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-slate-50 opacity-50"></div>
            <div class="relative p-4 md:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-gray-400 to-slate-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $statusCounts['completed'] }}</p>
                        <p class="text-gray-600 text-xs md:text-sm font-medium">Completed</p>
                    </div>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-gradient-to-r from-gray-400 to-slate-500 h-1.5 rounded-full transition-all duration-1000"
                        style="width: {{ $statusCounts['completed'] > 0 ? min(($statusCounts['completed'] / max(array_sum($statusCounts), 1)) * 100, 100) : 0 }}%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Cancelled Card -->
        <div
            class="group relative overflow-hidden bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-red-100 hover:border-red-200">
            <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-rose-50 opacity-50"></div>
            <div class="relative p-4 md:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-red-400 to-rose-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $statusCounts['cancelled'] }}</p>
                        <p class="text-red-600 text-xs md:text-sm font-medium">Cancelled</p>
                    </div>
                </div>
                <div class="w-full bg-red-100 rounded-full h-1.5">
                    <div class="bg-gradient-to-r from-red-400 to-rose-500 h-1.5 rounded-full transition-all duration-1000"
                        style="width: {{ $statusCounts['cancelled'] > 0 ? min(($statusCounts['cancelled'] / max(array_sum($statusCounts), 1)) * 100, 100) : 0 }}%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Filters and Search -->
    <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/50 p-6">
        <div class="flex flex-col space-y-4">
            <!-- Mobile First Approach -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Status Filter -->
                <div class="relative">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Status</label>
                    <div class="relative">
                        <select wire:model.live="selectedStatus"
                            class="w-full appearance-none bg-white border-2 border-gray-200 rounded-xl px-4 py-3 pr-10 text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 hover:border-gray-300">
                            <option value="all">🔍 Semua Status</option>
                            <option value="pending">⏳ Pending</option>
                            <option value="confirmed">✅ Confirmed</option>
                            <option value="in_progress">🔄 In Progress</option>
                            <option value="completed">✔️ Completed</option>
                            <option value="cancelled">❌ Cancelled</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Search Input -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pencarian</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input wire:model.live="search" type="text"
                            placeholder="🔍 Cari plat nomor, nama mobil, atau customer..."
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 hover:border-gray-300 bg-white">

                        @if ($search)
                            <button wire:click="$set('search', '')"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Results Count -->
            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                <div class="text-sm text-gray-600 font-medium">
                    📊 Total: <span class="font-bold text-gray-800">{{ $bookings->total() }}</span> booking
                </div>
                @if ($search || $selectedStatus !== 'all')
                    <button wire:click="$set('search', ''); $set('selectedStatus', 'all')"
                        class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                        Reset Filter
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Modern Bookings List -->
    <div class="space-y-4">
        @if ($bookings->count() > 0)
            @foreach ($bookings as $booking)
                <div
                    class="group bg-white/90 backdrop-blur-lg rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-white/50 overflow-hidden hover:border-blue-200">
                    <div class="p-6">
                        <!-- Mobile-First Card Header -->
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-4">
                            <div class="flex flex-wrap items-center gap-2">
                                <!-- Status Badge -->
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $booking->status_color }} shadow-sm">
                                    @switch($booking->status)
                                        @case('pending')
                                            ⏳ {{ $booking->status_text }}
                                        @break

                                        @case('confirmed')
                                            ✅ {{ $booking->status_text }}
                                        @break

                                        @case('in_progress')
                                            🔄 {{ $booking->status_text }}
                                        @break

                                        @case('completed')
                                            ✔️ {{ $booking->status_text }}
                                        @break

                                        @case('cancelled')
                                            ❌ {{ $booking->status_text }}
                                        @break

                                        @default
                                            {{ $booking->status_text }}
                                    @endswitch
                                </span>

                                <!-- Queue Number -->
                                @if ($booking->queue_number)
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 shadow-sm">
                                        🎯 Antrian #{{ $booking->queue_number }}
                                    </span>
                                @endif
                            </div>

                            <!-- Action Button -->
                            <a href="{{ route('admin.pengerjaan', ['id' => $booking->id]) }}"
                                class="inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-yellow-200 to-yellow-300 text-white text-sm font-semibold rounded-xl hover:from-yellow-200 hover:to-yellow-400 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-200 shadow-lg hover:shadow-xl group-hover:scale-105 transform">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                        </div>

                        <!-- Card Content Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Vehicle Info -->
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-yellow-300 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-gray-900 truncate">{{ $booking->car_name }}
                                        </h3>
                                        <p class="text-sm text-gray-600 flex items-center space-x-2">
                                            <span class="font-semibold">{{ $booking->license_plate }}</span>
                                            <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                                            <span>{{ $booking->car_color }}</span>
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            👤 Customer: <span
                                                class="font-medium">{{ $booking->customer->name ?? 'N/A' }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Details -->
                            <div class="space-y-3">
                                <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">📅 Tanggal Booking</span>
                                        <span class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">📦 Paket</span>
                                        <span class="text-sm font-semibold text-gray-900">
                                            {{ $booking->packagePrice->servicePackage->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                        <span class="text-sm font-semibold text-gray-700">💰 Total</span>
                                        <span class="text-lg font-bold text-green-600">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}K
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        @if ($booking->notes)
                            <div
                                class="mt-4 bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200 rounded-xl p-4">
                                <div class="flex items-start space-x-2">
                                    <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-yellow-800">Catatan:</p>
                                        <p class="text-sm text-yellow-700 mt-1">{{ $booking->notes }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Progress bar for visual feedback -->
                    <div class="h-1 bg-gray-100">
                        @switch($booking->status)
                            @case('pending')
                                <div
                                    class="h-full bg-gradient-to-r from-yellow-400 to-amber-500 w-1/5 transition-all duration-1000">
                                </div>
                            @break

                            @case('confirmed')
                                <div
                                    class="h-full bg-gradient-to-r from-blue-400 to-cyan-500 w-2/5 transition-all duration-1000">
                                </div>
                            @break

                            @case('in_progress')
                                <div
                                    class="h-full bg-gradient-to-r from-green-400 to-emerald-500 w-4/5 transition-all duration-1000">
                                </div>
                            @break

                            @case('completed')
                                <div
                                    class="h-full bg-gradient-to-r from-gray-400 to-slate-500 w-full transition-all duration-1000">
                                </div>
                            @break

                            @case('cancelled')
                                <div
                                    class="h-full bg-gradient-to-r from-red-400 to-rose-500 w-full transition-all duration-1000">
                                </div>
                            @break
                        @endswitch
                    </div>
                </div>
            @endforeach

            <!-- Enhanced Pagination -->
            <div class="backdrop-blur-xl rounded-2xl border border-white/50 p-6">
                {{ $bookings->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-sm border border-white/50 text-center py-16">
                <div
                    class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak ada booking ditemukan</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">
                    @if ($search || $selectedStatus !== 'all')
                        Tidak ada booking yang sesuai dengan filter yang dipilih. Coba ubah kriteria pencarian.
                    @else
                        Belum ada booking yang masuk ke sistem.
                    @endif
                </p>
                @if ($search || $selectedStatus !== 'all')
                    <button wire:click="$set('search', ''); $set('selectedStatus', 'all')"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Semua Filter
                    </button>
                @endif
            </div>
        @endif
    </div>

    <!-- Floating Action Button for Mobile -->
    <div class="fixed bottom-20 right-4 md:bottom-8 md:right-8 z-10">
        <button
            class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full shadow-xl hover:shadow-2xl hover:scale-110 transition-all duration-300 flex items-center justify-center group">
            <svg class="w-6 h-6 transition-transform duration-300 group-hover:rotate-180" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </button>
    </div>

    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>

@push('script')
    <script>
        document.addEventListener('livewire:init', () => {
            // Enhanced notification system
            const showNotification = (message, type = 'success') => {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-xl shadow-lg border-l-4 ${
                    type === 'success' ? 'border-green-500' : 'border-red-500'
                } transform transition-all duration-300 translate-x-full`;

                notification.innerHTML = `
                    <div class="p-4 flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            ${type === 'success' ?
                                '<div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center"><svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></div>' :
                                '<div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center"><svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></div>'
                            }
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">${message}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                `;

                document.body.appendChild(notification);

                // Animate in
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                // Auto hide after 5 seconds
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            };

            // Livewire event listeners with enhanced notifications
            Livewire.on('booking-confirmed', (event) => {
                showNotification(event.message, 'success');
            });

            Livewire.on('booking-cancelled', (event) => {
                showNotification(event.message, 'success');
            });

            Livewire.on('booking-started', (event) => {
                showNotification(event.message, 'success');
            });

            Livewire.on('booking-completed', (event) => {
                showNotification(event.message, 'success');
            });

            // Auto-refresh every 30 seconds for real-time updates
            setInterval(() => {
                Livewire.dispatch('refresh');
            }, 30000);
        });

        // Floating Action Button functionality
        document.addEventListener('DOMContentLoaded', function() {
            const fab = document.querySelector('.fixed.bottom-20 button, .fixed.bottom-8 button');
            if (fab) {
                fab.addEventListener('click', function() {
                    // Scroll to top with smooth animation
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });

                    // Refresh the page data
                    Livewire.dispatch('refresh');
                });
            }
        });
    </script>
@endpush
