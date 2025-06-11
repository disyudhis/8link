<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bookings;
use App\Models\CarCategories;
use App\Models\PackagePrices;
use App\Models\ServicePackages;
use Illuminate\Support\Facades\Auth;

class PaketPengerjaan extends Component
{
    public $step = 1;
    public $carTypes;
    public $disabledSizes = true; // Default to disabled - user cannot select size manually
    public $servicePackages = [];
    public $selectedPackage = null;
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $filterActive = false;
    public $selectedPackagePrice = null;

    public $vehicleData = [
        'car_name' => '',
        'car_color' => '',
        'plate_number' => '',
        'car_type' => '',
        'size' => '',
        'service_date' => '',
        'notes' => '',
        'service_package_id' => '',
        'package_price' => '',
        'package_price_id' => '', // Added field to store the package_price_id
    ];

    protected $rules = [
        'vehicleData.car_name' => 'required',
        'vehicleData.car_color' => 'required',
        'vehicleData.car_type' => 'required',
        'vehicleData.plate_number' => 'required',
        'vehicleData.size' => 'required|in:S,M,L,XL',
        'vehicleData.service_date' => 'required|date|after_or_equal:today',
        'vehicleData.service_package_id' => 'required|exists:service_packages,id',
    ];

    protected $messages = [
        'vehicleData.car_name.required' => 'Nama kendaraan harus diisi',
        'vehicleData.car_color.required' => 'Warna kendaraan harus diisi',
        'vehicleData.car_type.required' => 'Tipe kendaraan harus diisi',
        'vehicleData.plate_number.required' => 'Nomor plat harus diisi',
        'vehicleData.size.required' => 'Ukuran kendaraan harus dipilih',
        'vehicleData.service_date.required' => 'Tanggal servis harus diisi',
        'vehicleData.service_date.date' => 'Format tanggal tidak valid',
        'vehicleData.service_date.after_or_equal' => 'Tanggal servis minimal hari ini',
        'vehicleData.service_package_id.required' => 'Paket layanan harus dipilih',
    ];

    public function mount()
    {
        $this->vehicleData['service_date'] = date('Y-m-d');
        $this->carTypes = CarCategories::all();
        $this->loadServicePackages();
    }

    public function loadServicePackages()
    {
        $this->servicePackages = ServicePackages::with(['packagePrices' => function($query) {
            if (!empty($this->vehicleData['car_type'])) {
                $carType = CarCategories::find($this->vehicleData['car_type']);
                if ($carType) {
                    $query->whereHas('carCategory', function($q) use ($carType) {
                        $q->where('code', $carType->code);
                    });
                }
            }
        }])->get();
    }

    public function nextStep()
    {
        // Validasi berdasarkan step saat ini
        if ($this->step === 1) {
            $this->validate([
                'vehicleData.car_name' => 'required',
                'vehicleData.car_color' => 'required',
                'vehicleData.car_type' => 'required',
                'vehicleData.plate_number' => 'required',
                'vehicleData.size' => 'required|in:S,M,L,XL',
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'vehicleData.service_date' => 'required|date|after_or_equal:today',
            ]);
        } elseif ($this->step === 3) {
            $this->validate([
                'vehicleData.service_package_id' => 'required|exists:service_packages,id',
            ]);
        }

        $this->step++;

        if ($this->step === 3) {
            $this->loadServicePackages();
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function updateCarSize()
    {
        if (!empty($this->vehicleData['car_type'])) {
            $carType = CarCategories::find($this->vehicleData['car_type']);

            if ($carType) {
                // Set size otomatis berdasarkan tipe mobil dari database
                $this->vehicleData['size'] = $carType->code;
            } else {
                $this->vehicleData['size'] = '';
            }
        } else {
            $this->vehicleData['size'] = '';
        }
    }

    public function selectPackage($packageId)
    {
        $this->selectedPackage = $packageId;
        $this->vehicleData['service_package_id'] = $packageId;

        // Get price for selected package and car size
        if (!empty($this->vehicleData['car_type'])) {
            $carType = CarCategories::find($this->vehicleData['car_type']);
            if ($carType) {
                $price = PackagePrices::where('service_package_id', $packageId)
                    ->whereHas('carCategory', function($query) use ($carType) {
                        $query->where('code', $carType->code);
                    })
                    ->first();

                if ($price) {
                    $this->vehicleData['package_price'] = $price->price;
                    $this->vehicleData['package_price_id'] = $price->id; // Store the package_price_id
                    $this->selectedPackagePrice = $price;
                }
            }
        }
    }

    public function finishBooking()
    {
        // Validasi semua data
        $this->validate();

        try {
            // Save booking to database
            $booking = Bookings::create([
                'customer_id' => Auth::id(), // Assuming customer is logged in
                'package_price_id' => $this->vehicleData['package_price_id'],
                'license_plate' => $this->vehicleData['plate_number'],
                'car_name' => $this->vehicleData['car_name'],
                'car_color' => $this->vehicleData['car_color'],
                'booking_date' => $this->vehicleData['service_date'],
                'status' => 'pending', // Default status for new bookings
                'total_price' => $this->vehicleData['package_price'],
                'notes' => $this->vehicleData['notes'] ?? null,
                'queue_number' => 'Q-' . date('Ymd') . '-' . str_pad(Bookings::count() + 1, 4, '0', STR_PAD_LEFT),
            ]);

            $booking->checklist()->create([
                'booking_id' => $booking->id,
            ]);

            // Store booking ID in session
            session(['booking_id' => $booking->id]);
            session(['vehicle_booking_data' => $this->vehicleData]);

            // Show success message
            session()->flash('message', 'Reservasi berhasil dibuat!');

            // Redirect to confirmation/checkout page
            return redirect()->route('user.reservasi.show', $booking->id);

        } catch (\Exception $e) {
            // Log error
            \Log::error('Booking creation failed: ' . $e->getMessage());
            // Show error message
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data reservasi. Silakan coba lagi.');
        }
    }

    public function render()
    {
        $packages = $this->servicePackages;

        // Get correct pricing for each package based on car size
        foreach ($packages as $package) {
            $package->currentPrice = null;

            if (!empty($this->vehicleData['car_type'])) {
                $carType = CarCategories::find($this->vehicleData['car_type']);
                if ($carType) {
                    $price = $package->packagePrices()
                        ->whereHas('carCategory', function($query) use ($carType) {
                            $query->where('code', $carType->code);
                        })
                        ->first();

                    if ($price) {
                        $package->currentPrice = $price->price;
                    }
                }
            }
        }

        return view('livewire.paket-pengerjaan', [
            'packages' => $packages
        ])->layout('layouts.base', [
            'title' => 'Paket Pengerjaan'
        ]);
    }
}
