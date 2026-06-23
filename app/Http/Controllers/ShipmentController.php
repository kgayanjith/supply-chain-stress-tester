<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if (Shipment::count() == 0) {
      $response = Http::get(
        'https://api.elaneglobal.com/v1/AIS/VesselPositionMulti',
        [
            'key' => env('ELANE_API_KEY'),
            'mmsis' => '417222410,417222405,417222444'
        ]
    );

           $shipData = $response->json('data') ?? [];

        foreach ($shipData as $ship) {

            Shipment::firstOrCreate(
                ['mmsi' => $ship['mmsi']],
                [
                    'imo'       => $ship['imo'] ?? null,
                    'call_sign' => $ship['call_sign'] ?? null,
                    'ship_name' => $ship['ship_name'] ?? null,
                    'dest'      => $ship['dest'] ?? null,
                    'lat'       => $ship['lat'] ?? null,
                    'lng'       => $ship['lng'] ?? null,
                    'sog'       => $ship['sog'] ?? null,
                    'cog'       => $ship['cog'] ?? null,
                ]
            );
        }
    }

        $shipments = Shipment::all();

        return inertia('Backend/Shipments/Index', ['shipments' => $shipments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function track($id)
    {
        // dd($id);
        $shipments = Shipment::find($id);
        return inertia('Backend/Shipments/Tracking', ['shipments' => $shipments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
}
