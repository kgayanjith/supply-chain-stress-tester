<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
     protected $fillable = [
        'mmsi',
        'imo',
        'call_sign',
        'ship_name',
        'dest',
        'lat',
        'lng',
        'sog',
        'cog',
    ];
}
