<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        $vehicles = Vehicle::latest()->paginate(5);
        return view('vehicle.index', compact('vehicles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('vehicle.create-vehicle');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:15',
                'regex:/^[A-Z]{2}[ -]?[0-9]{2}[ -]?[A-Z]{1,2}[ -]?[0-9]{4}$/',
                Rule::unique('vehicles', 'name'),
            ],
            'vehicle_name' => 'required|string|max:255',
            'vehicle_tare_weight' => 'required|numeric',
        ]);
    
        Vehicle::create($validated);
    
        return redirect()->route('sales.create')->with('success', 'Vehicle Added Successfully');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        
        return redirect()->route('vehicle.index')
            ->with('success', 'Vehicle deleted successfully');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.create-vehicle', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:15',
                'regex:/^[A-Z]{2}[ -]?[0-9]{2}[ -]?[A-Z]{1,2}[ -]?[0-9]{4}$/',
                Rule::unique('vehicles', 'name')->ignore($vehicle->id),
            ],
            'vehicle_name' => 'required|string|max:255',
            'vehicle_tare_weight' => 'required|numeric',
        ]);
    
        $vehicle->update($validated);
    
        return redirect()->route('sales.create')->with('success', 'Vehicle Updated Successfully');
    }

    public function fetchDetails(Request $request)
    {
        // ... (This method remains the same) ...
        $vehicleId = $request->input('id');
        if (!$vehicleId) {
            return response()->json(['error' => 'Vehicle ID not provided.'], 400);
        }

        $vehicle = DB::table('vehicles')->where('id', $vehicleId)->first();

        if ($vehicle) {
            return response()->json($vehicle);
        } else {
            return response()->json(['error' => 'Vehicle not found.'], 404);
        }
    }
}
