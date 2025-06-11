<div class="max-w-md mx-auto bg-gradient-to-b from-gray-50 to-white min-h-screen flex flex-col">
    <!-- Header with curved design -->
    <div class="bg-gradient-to-r from-yellow-300 to-yellow-200 text-black p-4 rounded-b-[40px] pb-16 relative shadow-lg">
        <div class="flex items-center mb-6">
            <a href="{{ Auth::user()->user_type == \App\Models\User::ROLE_ADMIN ? route('admin.antrian') : route('user.reservasi.index') }}"
                class="text-black hover:text-gray-800 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl font-bold ml-4">Detail Reservasi</h1>
        </div>

        <div class="flex flex-col items-center">
            <!-- Animated logo appearance -->
            <div
                class="w-24 h-24 bg-black rounded-full mb-3 overflow-hidden border-4 border-white shadow-lg transform transition-transform hover:scale-105 duration-300">
                <img src="{{ asset('icon/8link yellow (no bg).png') }}" alt="Profile"
                    class="w-full h-full object-cover">
            </div>
            <h2 class="text-2xl font-bold">Nomor Antrian</h2>
            <div class="text-3xl font-extrabold mt-1 bg-white px-6 py-2 rounded-full shadow-md">
                {{ $booking->queue_number ?? 'A-007' }}
            </div>
            <p class="text-sm text-black/80 mt-2">Detail kendaraan Anda</p>
        </div>
    </div>

    <!-- Card Info with enhanced design -->
    <div class="px-5 -mt-10 z-5">
        <div
            class="bg-white rounded-2xl shadow-xl p-6 mb-6 border border-gray-100 transform transition-transform hover:shadow-2xl duration-300">
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        Nama Pemilik
                    </span>
                    <span class="text-gray-800 font-semibold">{{ $booking->customer->name }}</span>
                </div>
                <div class="border-b border-gray-200"></div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            <path
                                d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H11a1 1 0 001-1v-1h3.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-4a1 1 0 00-.293-.707l-3-3A1 1 0 0016 5h-3a1 1 0 00-1-1H3z" />
                        </svg>
                        Mobil
                    </span>
                    <span class="text-gray-800 font-semibold">{{ $booking->car_name }}</span>
                </div>
                <div class="border-b border-gray-200"></div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Warna
                    </span>
                    <span class="text-gray-800 font-semibold">{{ $booking->car_color }}</span>
                </div>
                <div class="border-b border-gray-200"></div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 2a1 1 0 011 1v1h8V3a1 1 0 112 0v1h1a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 011-1zm11 14a1 1 0 001-1V6a1 1 0 00-1-1H4a1 1 0 00-1 1v9a1 1 0 001 1h12z"
                                clip-rule="evenodd" />
                        </svg>
                        Paket
                    </span>
                    <span class="text-gray-800 font-semibold">{{ $booking->packagePrice->servicePackage->name }}</span>
                </div>
                <div class="border-b border-gray-200"></div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                        Plat Nomor
                    </span>
                    <span class="text-gray-800 font-semibold">{{ $booking->license_plate }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Timeline -->
    {{-- <div class="px-5 mb-6">
        <div class="bg-white rounded-2xl shadow-lg p-5 border border-gray-100">
            <h3 class="text-lg font-bold mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                Status Pengerjaan
            </h3>

            <div class="space-y-3">
                <div class="flex items-center space-x-3">
                    @foreach ($this->statuses as $key => $status)
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-6 h-6 rounded-full
                                {{ $status['current'] ? 'bg-primary' :
                                   ($status['completed'] ? 'bg-green-500' : 'bg-gray-300') }}
                                flex items-center justify-center text-white text-xs mb-1">
                                @if ($status['completed'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    {{ $status['order'] }}
                                @endif
                            </div>
                            <span class="text-xs {{ $status['current'] ? 'text-black font-bold' :
                                ($status['completed'] ? 'text-gray-700' : 'text-gray-500') }} text-center">
                                {{ $status['label'] }}
                            </span>
                        </div>

                        @if (!$loop->last)
                            <div class="flex-1 h-0.5 {{ $status['completed'] ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Tanggal Pengerjaan -->
    <div class="px-5 flex-grow">
        <div class="bg-white rounded-2xl shadow-lg p-5 mb-6 border border-gray-100">
            <div class="text-center mb-3">
                <p class="text-gray-500 text-sm mb-1">Masuk bengkel pada tanggal</p>
                <h3 class="text-xl font-bold text-gray-800 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}
                </h3>
            </div>
        </div>

        <!-- Notes if available -->
        @if ($booking->notes)
            <div class="bg-white rounded-2xl shadow-lg p-5 mb-6 border border-gray-100">
                <h3 class="text-lg font-bold mb-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    Catatan
                </h3>
                <p class="text-gray-700">{{ $booking->notes }}</p>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="space-y-3 mb-20">
            <a href="{{ $this->getWhatsappUrl() }}" target="_blank"
                class="w-full bg-green-500 hover:bg-green-600 text-white py-4 px-4 rounded-xl flex items-center justify-center transition duration-300 shadow-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
                Chat Dengan Teknisi
            </a>

            <a type="button" href="{{ route('user.checklist', $booking->id) }}"
                class="w-full bg-primary hover:bg-yellow-200 text-black py-4 px-4 rounded-xl flex items-center justify-center transition duration-300 shadow-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                Checklist dengan Pekerja
            </a>
        </div>
    </div>
    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>
