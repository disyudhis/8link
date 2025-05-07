<div class="px-2 py-2">
    <div class="text-sm text-gray-700">
        @if ($step === 1)
            Masukkan data kendaraan Anda untuk melanjutkan
        @elseif ($step === 2)
            Pilih tanggal dan waktu pengerjaan kendaraan Anda
        @elseif($step === 3)
            Pilih paket pengerjaan yang sesuai dengan kebutuhan Anda
        @else
            Ringkasan pesanan Anda
        @endif
    </div>

    <!-- Progress Indicator -->
    <div>
        <div class="flex items-center justify-between mb-1">
            @for ($i = 1; $i <= 4; $i++)
                <div class="flex flex-col items-center">
                    <div
                        class="rounded-full h-8 w-8 flex items-center justify-center {{ $step >= $i ? 'bg-primary text-black' : 'bg-gray-300 text-gray-600' }} mb-1">
                        {{ $i }}
                    </div>
                    <span class="text-xs {{ $step >= $i ? 'text-black font-medium' : 'text-gray-500' }}">
                        @if ($i === 1)
                            Data
                        @elseif ($i === 2)
                            Jadwal
                        @elseif ($i === 3)
                            Paket
                        @else
                            Ringkasan
                        @endif
                    </span>
                </div>

                @if ($i < 4)
                    <div class="flex-1 h-1 {{ $step > $i ? 'bg-primary' : 'bg-gray-300' }} mx-2"></div>
                @endif
            @endfor
        </div>
    </div>

    <!-- Form Data Mobil -->
    <div>
        <!-- Step 1: Data Kendaraan -->
        @if ($step === 1)
            <x-ui.card>
                <h3 class="font-semibold text-lg mb-3">Informasi Kendaraan</h3>

                {{-- Nama Mobil --}}
                <div class="mb-4">
                    <label for="car_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Mobil</label>
                    <input type="text" id="car_name" wire:model.live="vehicleData.car_name"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                        placeholder="Contoh: Avanza, Xenia, Jazz">
                    @error('vehicleData.car_name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tipe Mobil -->
                <div class="mb-4">
                    <label for="car_type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Mobil</label>
                    <select id="car_type" wire:model.live="vehicleData.car_type" wire:change="updateCarSize"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Pilih Tipe</option>
                        @foreach ($carTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('vehicleData.car_type')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror

                    <div class="mt-2 text-xs text-gray-600 bg-gray-50 p-2 rounded-md">
                        <p class="font-medium mb-1">Informasi Tipe Mobil:</p>
                        <ul class="list-disc pl-4 space-y-1">
                            <li><span class="font-medium">LCGC:</span> City Car dengan harga terjangkau (Agya, Ayla,
                                Brio)</li>
                            <li><span class="font-medium">Medium:</span> MPV & SUV ukuran sedang (Avanza, Xenia, Rush)
                            </li>
                            <li><span class="font-medium">Large:</span> SUV & MPV besar (Fortuner, Pajero, CR-V)</li>
                            <li><span class="font-medium">Luxury:</span> Mobil premium (BMW, Mercedes, Lexus)</li>
                        </ul>
                    </div>
                </div>

                <!-- Warna Mobil -->
                <div class="mb-4">
                    <label for="car_color" class="block text-sm font-medium text-gray-700 mb-1">Warna Mobil</label>
                    <input type="text" id="car_color" wire:model.defer="vehicleData.car_color"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                        placeholder="Contoh: Merah, Putih, Hitam">
                    @error('vehicleData.car_color')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor Plat -->
                <div class="mb-4">
                    <label for="plate_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Plat</label>
                    <input type="text" id="plate_number" wire:model.defer="vehicleData.plate_number"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                        placeholder="Contoh: B 1234 ABC">
                    @error('vehicleData.plate_number')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jenis Mobil (Size) - Auto selected based on car_type -->
                <div class="mb-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ukuran Kendaraan (Otomatis)</label>
                    <div class="flex space-x-3">
                        @foreach (['S', 'M', 'L', 'XL'] as $size)
                            <button type="button"
                                class="w-12 h-12 rounded-full {{ $vehicleData['size'] === $size ? 'bg-primary text-black ring-2 ring-primary ring-offset-2' : 'bg-gray-200 text-gray-700' }} flex items-center justify-center text-sm font-medium transition-all"
                                disabled>
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                    <p class="mt-3 text-xs text-center text-blue-600">
                        <i class="fas fa-info-circle mr-1"></i>Ukuran kendaraan ditentukan otomatis berdasarkan tipe
                        mobil yang dipilih
                    </p>
                    @error('vehicleData.size')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </x-ui.card>

            <!-- Action Button -->
            <div class="mt-6">
                <x-ui.button wire:click="nextStep" color="primary" fullWidth="true">
                    SELANJUTNYA
                </x-ui.button>
            </div>

            <!-- Step 2: Jadwal Pengerjaan -->
        @elseif ($step === 2)
            <x-ui.card>
                <h3 class="font-semibold text-lg mb-3">Jadwal Pengerjaan</h3>

                <!-- Tanggal Masuk -->
                <div class="mb-4">
                    <label for="service_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                    <input type="date" id="service_date" wire:model.defer="vehicleData.service_date"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                        min="{{ date('Y-m-d') }}">
                    @error('vehicleData.service_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Catatan Tambahan -->
                <div class="mb-1">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan
                        (Opsional)</label>
                    <textarea id="notes" wire:model.defer="vehicleData.notes" rows="3"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                        placeholder="Masukkan catatan tambahan jika ada"></textarea>
                </div>
            </x-ui.card>

            <!-- Action Button -->
            <div class="mt-6 flex space-x-3">
                <x-ui.button wire:click="previousStep" color="secondary" fullWidth="true">
                    KEMBALI
                </x-ui.button>
                <x-ui.button wire:click="nextStep" color="primary" fullWidth="true">
                    SELANJUTNYA
                </x-ui.button>
            </div>


            <!-- Step 3: Pilih Paket -->
        @elseif ($step === 3)
            <!-- Package Selection View -->
            <div>
                <h3 class="font-semibold text-lg mb-3">Pilih Paket Layanan</h3>

                <!-- Packages List -->
                <div class="space-y-4">
                    @foreach ($packages as $package)
                        @if ($package->currentPrice)
                            <div
                                wire:click="selectPackage({{ $package->id }})"
                                class="bg-white border rounded-lg overflow-hidden shadow-sm cursor-pointer hover:shadow-md transition-all
                                      {{ $selectedPackage === $package->id ? 'border-yellow-400 ring-2 ring-yellow-400' : 'border-gray-200' }}"
                            >
                                <div class="p-4">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-semibold mb-1">{{ $package->name }}</h3>
                                        @if ($selectedPackage === $package->id)
                                            <div class="bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-medium">Terpilih</div>
                                        @endif
                                    </div>

                                    <p class="text-gray-600 text-sm mb-3">{{ $package->description }}</p>

                                    <div>
                                        <p class="text-xl font-bold">
                                            Rp.{{ number_format($package->currentPrice, 0, ',', '.') }}K
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                @error('vehicleData.service_package_id')
                    <div class="mt-2 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action Button -->
            <div class="mt-6 flex space-x-3">
                <x-ui.button wire:click="previousStep" color="secondary" fullWidth="true">
                    KEMBALI
                </x-ui.button>
                <x-ui.button wire:click="nextStep" color="primary" fullWidth="true">
                    SELANJUTNYA
                </x-ui.button>
            </div>
            <!-- Step 4: Ringkasan Pesanan -->
        @elseif ($step === 4)
            <x-ui.card>
                <h3 class="font-semibold text-lg mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-4">
                    <!-- Informasi Kendaraan -->
                    <div class="border-b pb-3">
                        <h4 class="font-medium text-gray-700 mb-2">Informasi Kendaraan</h4>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="text-gray-600">Nama Kendaraan:</div>
                            <div class="font-medium">{{ $vehicleData['car_name'] }}</div>

                            <div class="text-gray-600">Warna:</div>
                            <div class="font-medium">{{ $vehicleData['car_color'] }}</div>

                            <div class="text-gray-600">Nomor Plat:</div>
                            <div class="font-medium">{{ $vehicleData['plate_number'] }}</div>

                            <div class="text-gray-600">Tipe Kendaraan:</div>
                            <div class="font-medium">
                                @if ($vehicleData['car_type'])
                                    {{ $carTypes->where('id', $vehicleData['car_type'])->first()->name ?? '' }}
                                @endif
                            </div>

                            <div class="text-gray-600">Ukuran:</div>
                            <div class="font-medium">{{ $vehicleData['size'] }}</div>
                        </div>
                    </div>

                    <!-- Jadwal Pengerjaan -->
                    <div class="border-b pb-3">
                        <h4 class="font-medium text-gray-700 mb-2">Jadwal Pengerjaan</h4>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="text-gray-600">Tanggal Masuk:</div>
                            <div class="font-medium">{{ date('d F Y', strtotime($vehicleData['service_date'])) }}
                            </div>

                            @if (!empty($vehicleData['notes']))
                                <div class="text-gray-600">Catatan:</div>
                                <div class="font-medium">{{ $vehicleData['notes'] }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Paket Layanan -->
                    <div>
                        <h4 class="font-medium text-gray-700 mb-2">Paket Layanan</h4>
                        @if ($selectedPackage)
                            @php
                                $selectedPackageDetails = $packages->where('id', $selectedPackage)->first();
                            @endphp
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h5 class="font-semibold">{{ $selectedPackageDetails->name }}</h5>
                                        <p class="text-gray-600 text-sm">{{ $selectedPackageDetails->description }}
                                        </p>
                                    </div>
                                    <div class="text-xl font-bold">
                                        Rp.{{ number_format($selectedPackageDetails->currentPrice, 0, ',', '.') }}K
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </x-ui.card>

            <!-- Action Button -->
            <div class="mt-6 flex space-x-3">
                <x-ui.button wire:click="previousStep" color="secondary" fullWidth="true">
                    KEMBALI
                </x-ui.button>
                <x-ui.button wire:click="finishBooking" color="primary" fullWidth="true">
                    KONFIRMASI PESANAN
                </x-ui.button>
            </div>
        @endif
    </div>

    <x-slot name="bottomNavigation">
        <x-mobile-bottom-navigation />
    </x-slot>
</div>
