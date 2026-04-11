<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {

        try {
            $banners = Banner::with('media')->where(['status' => 1])->get();

            $banners = BannerResource::collection($banners);
            return response()->json([
                'status'  => 'success',
                'message' => 'Categories fetched successfully',
                'data'    => $banners,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to fetch banners',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }
}
