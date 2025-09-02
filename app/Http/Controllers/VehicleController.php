<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'vehicle_name' => 'required',
            'vehicle_tare_weight' => 'required',
        ]);
        Vehicle::create($validated);        
        return redirect()->route('sales.create')->with('success', 'Vehicle Added Successfully');
    }
}
