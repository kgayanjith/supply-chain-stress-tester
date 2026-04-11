<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class BannerService
{
    /**
     * Create a new class instance.
     */
    public function create(array $data): Banner
    {
        return DB::transaction(function () use ($data) {

            $banner = Banner::create([
                'name' => trim($data['name']),
                'status' => (bool) ($data['status'] ?? 1),
            ]);

            $banner->addMedia($data['image'])->toMediaCollection('banners');


            return $banner->refresh();
        });
    }

    public function update(Banner $banner, array $data): Banner
    {
        return DB::transaction(function () use ($banner, $data) {

            $banner->update([
                'name' => trim($data['name']),
                'status' => (bool) ($data['status'] ?? 1),
            ]);


            if (!empty($data['image']) && $data['image'] instanceof UploadedFile) {
                $banner->clearMediaCollection('banners');
                $banner->addMedia($data['image'])->toMediaCollection('banners');
            }



            return $banner->refresh();
        });
    }
}
