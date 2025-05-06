<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CarCategories;
use App\Models\PackagePrices;
use App\Models\ServicePackages;

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
                }
            }
        }
    }

    public function finishBooking()
    {
        // Validasi semua data
        $this->validate();

        // Save to session for checkout
        session(['vehicle_booking_data' => $this->vehicleData]);

        // Redirect to confirmation/checkout page
        return redirect()->route('reservasi');
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