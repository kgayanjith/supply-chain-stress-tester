<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::with('media')->get();

        return Inertia::render('Banners/Index',['banners' => $banners]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Banners/CreateUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request, BannerService $service)
    {

        $service->create($request->validated());

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);

        $banners = Banner::find($id);

        return Inertia::render('Banners/CreateUpdate', ['banners' => $banners]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner, BannerService $service)
    {
           $service->update($banner, $request->validated());

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()
            ->route('banner.index')
            ->with('success', 'Product deleted successfully.');
    }
}
