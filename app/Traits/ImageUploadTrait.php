<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

trait ImageUploadTrait
{
    /**
     * Upload dan optimasi gambar.
     * Menggunakan Intervention Image v4 (standard terbaru).
     * Mengubah format ke WebP untuk ukuran yang lebih ringan tanpa mengurangi kejernihan secara signifikan.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param int|null $width
     * @param int|null $height
     * @return string
     */
    public function uploadImage($file, $folder, $width = 1200, $height = null)
    {
        // 1. Inisialisasi Image Manager dengan driver GD
        $manager = new ImageManager(new Driver());

        // 2. Buat nama file unik dengan ekstensi .webp
        $filename = time() . '_' . uniqid() . '.webp';
        $path = $folder . '/' . $filename;

        // 3. Baca gambar dari file upload menggunakan decode() (v4 ganti dari read/make)
        $image = $manager->decode($file);

        // 4. Resize gambar jika lebih lebar dari batas yang ditentukan
        if ($image->width() > $width) {
            $image->scale(width: $width, height: $height);
        }

        // 5. Encode ke format WebP dengan kualitas 80%
        // Di v4 menggunakan Encoder class secara eksplisit
        $encoded = $image->encode(new WebpEncoder(quality: 80));

        // 6. Simpan hasil kompresi ke storage public
        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }

    /**
     * Menghapus gambar dari storage.
     *
     * @param string|null $path
     * @return void
     */
    public function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
