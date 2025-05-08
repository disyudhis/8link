<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bookings;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Checklist as ChecklistModel;

class Checklist extends Component
{
    use WithFileUploads;

    public $bookingId;
    public $notes;
    public $booking;

    // Temporary image uploads
    public $frontBumperImage;
    public $rearBumperImage;
    public $hoodImage;
    public $roofImage;
    public $leftSideImage;
    public $rightSideImage;

    // Stored images
    public $images = [];

    // Define allowed mime types
    private $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];

    // Set maximum upload file size (2MB)
    private $maxFileSize = 2048;

    // Set image dimensions
    private $imageWidth = 800;
    private $imageHeight = 600;

    protected $rules = [
        'bookingId' => 'required|exists:bookings,id',
        'frontBumperImage' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        'rearBumperImage' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        'hoodImage' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        'roofImage' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        'leftSideImage' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        'rightSideImage' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        'notes' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'bookingId.required' => 'ID booking diperlukan',
        'bookingId.exists' => 'Booking tidak ditemukan',
        'frontBumperImage.image' => 'File harus berupa gambar',
        'frontBumperImage.mimes' => 'Format gambar harus jpeg, png, atau webp',
        'frontBumperImage.max' => 'Ukuran gambar maksimal 2MB',
        'rearBumperImage.image' => 'File harus berupa gambar',
        'rearBumperImage.mimes' => 'Format gambar harus jpeg, png, atau webp',
        'rearBumperImage.max' => 'Ukuran gambar maksimal 2MB',
        'hoodImage.image' => 'File harus berupa gambar',
        'hoodImage.mimes' => 'Format gambar harus jpeg, png, atau webp',
        'hoodImage.max' => 'Ukuran gambar maksimal 2MB',
        'roofImage.image' => 'File harus berupa gambar',
        'roofImage.mimes' => 'Format gambar harus jpeg, png, atau webp',
        'roofImage.max' => 'Ukuran gambar maksimal 2MB',
        'leftSideImage.image' => 'File harus berupa gambar',
        'leftSideImage.mimes' => 'Format gambar harus jpeg, png, atau webp',
        'leftSideImage.max' => 'Ukuran gambar maksimal 2MB',
        'rightSideImage.image' => 'File harus berupa gambar',
        'rightSideImage.mimes' => 'Format gambar harus jpeg, png, atau webp',
        'rightSideImage.max' => 'Ukuran gambar maksimal 2MB',
        'notes.max' => 'Catatan maksimal 1000 karakter',
    ];

    /**
     * Initialize component and load existing data
     *
     * @param int $bookingId
     * @return void
     */
    public function mount($bookingId)
    {
        $this->bookingId = $bookingId;

        try {
            // Verify booking exists before proceeding
            $this->booking = Bookings::findOrFail($bookingId);

            // Load existing checklist data if available
            $checklist = ChecklistModel::where('booking_id', $bookingId)->first();

            if ($checklist) {
                $this->loadExistingImages($checklist);
                $this->notes = $checklist->notes;
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Error loading vehicle inspection data: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat memuat data. Silakan coba lagi.');
            return redirect()->route('reservasi.index');
        }
    }

    /**
     * Load existing images from checklist
     *
     * @param Checklist $checklist
     * @return void
     */
    private function loadExistingImages(ChecklistModel $checklist)
    {
        $sections = ['front_bumper', 'rear_bumper', 'hood', 'roof', 'left_side', 'right_side'];

        foreach ($sections as $section) {
            if ($checklist->$section) {
                // Check if file exists in storage
                if ($this->fileExists($checklist->$section)) {
                    $this->images[$section] = $this->getPublicUrl($checklist->$section);
                } else {
                    $this->images[$section] = null;
                    // Log missing file
                    Log::warning("Missing checklist image for booking #{$this->bookingId}, section: {$section}");
                }
            } else {
                $this->images[$section] = null;
            }
        }
    }

    /**
     * Check if file exists in storage
     *
     * @param string $path
     * @return bool
     */
    private function fileExists($path)
    {
        return Storage::disk('public')->exists($path);
    }

    /**
     * Get public URL for stored image
     *
     * @param string $path
     * @return string
     */
    private function getPublicUrl($path)
    {
        // For cPanel setup, we need to adjust the URL generation
        if (config('app.env') === 'production') {
            // Get the base URL from app config
            $baseUrl = config('app.url');

            // Create the URL based on cPanel directories
            return $baseUrl . '/storage/' . $path;
        }

        // For local/development environment
        return Storage::url($path);
    }

    /**
     * Real-time image preview upon upload with validation
     * Using a generic handler for all image fields
     */
    public function updated($field)
    {
        // Define the mapping of fields to image keys
        $imageFieldMapping = [
            'frontBumperImage' => 'front_bumper',
            'rearBumperImage' => 'rear_bumper',
            'hoodImage' => 'hood',
            'roofImage' => 'roof',
            'leftSideImage' => 'left_side',
            'rightSideImage' => 'right_side',
        ];

        // Check if the updated field is one of our image fields
        if (array_key_exists($field, $imageFieldMapping)) {
            try {
                // Validate the specific field
                $this->validateOnly($field);

                // Get the file
                $file = $this->$field;

                // Additional validation checks
                if (!$file || !$file->isValid()) {
                    throw new \Exception('File tidak valid');
                }

                if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
                    throw new \Exception('Format file tidak diizinkan');
                }

                if ($file->getSize() > $this->maxFileSize * 1024) {
                    throw new \Exception('Ukuran file terlalu besar');
                }

                // Set the temporary URL in the images array
                $imageKey = $imageFieldMapping[$field];
                $this->images[$imageKey] = $file->temporaryUrl();
            } catch (\Exception $e) {
                // Reset the field on error
                $this->$field = null;
                $this->addError($field, $e->getMessage());
                Log::error('Vehicle inspection image validation error: ' . $e->getMessage());
            }
        }
    }

    /**
     * Save all inspection data with improved error handling
     */
    public function submitChecklist()
    {
        try {
            // Validate all fields
            $this->validate();

            $data = [
                'booking_id' => $this->bookingId,
                'notes' => $this->notes,
            ];

            // Process image uploads
            $imageFields = [
                'frontBumperImage' => 'front_bumper',
                'rearBumperImage' => 'rear_bumper',
                'hoodImage' => 'hood',
                'roofImage' => 'roof',
                'leftSideImage' => 'left_side',
                'rightSideImage' => 'right_side',
            ];

            foreach ($imageFields as $fieldName => $dbColumn) {
                if ($this->$fieldName) {
                    $data[$dbColumn] = $this->storeImage($this->$fieldName, $dbColumn);
                }
            }

            // Use database transaction to ensure data integrity
            \DB::beginTransaction();

            try {
                // Save or update checklist
                $checklist = ChecklistModel::updateOrCreate(['booking_id' => $this->bookingId], $data);

                \DB::commit();

                // Reset temporary uploads
                foreach (array_keys($imageFields) as $field) {
                    $this->reset($field);
                }

                session()->flash('message', 'Inspeksi kendaraan berhasil disimpan');

                // Redirect to booking details or next step
                return redirect()->route('reservasi.show', $this->bookingId);
            } catch (\Exception $e) {
                dd($e->getMessage());
                \DB::rollBack();
                Log::error('Error saving inspection checklist: ' . $e->getMessage());
                session()->flash('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            dd('submit', $e->getMessage());
            Log::error('Vehicle inspection validation error: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat validasi data. Silakan periksa kembali input Anda.');
        }
    }

    /**
     * Helper method to store and optimize uploaded images
     *
     * @param \Livewire\TemporaryUploadedFile $image
     * @param string $section
     * @return string
     */
    private function storeImage($image, $section)
    {
        try {
            // Tentukan path penyimpanan
            $storagePath = "vehicle-inspection/{$this->bookingId}";

            // Buat folder jika belum ada
            if (!Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->makeDirectory($storagePath);
            }

            // Buat nama file unik
            $filename = Str::slug($section) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $fullPath = "{$storagePath}/{$filename}";

            // Resize dan kompres gambar menggunakan Intervention
            $manager = new ImageManager(new Driver()); // Gd default, bisa diganti Imagick
            $resizedImage = $manager->read($image)->resize($this->imageWidth, $this->imageHeight)->toJpeg(80); // Kompres dengan kualitas 80%

            // Simpan file ke disk publik
            Storage::disk('public')->put($fullPath, $resizedImage->toString());

            return $fullPath;
        } catch (\Throwable $e) {
            dd($e->getMessage());
            Log::error('Gagal menyimpan gambar: ' . $e->getMessage());
            throw new \Exception('Gagal menyimpan gambar. Silakan coba lagi.');
        }
    }
    public function render()
    {
        return view('livewire.checklist')->layout('layouts.base')->title('Checklist');
    }
}
