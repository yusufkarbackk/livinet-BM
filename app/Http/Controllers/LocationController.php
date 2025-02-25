<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function showLocationList()
    {
        $locations = location::all();

        return view('locations', ['locations' => $locations]);
    }

    public function insertForm()
    {
        return view('addLocation');
    }

    public function insertLocationData(Request $request)
    {
        $location = new location();

        $locationInput = strtoupper($request->locationName);

        $location->location = $locationInput;
        $location->string_reference = $locationInput;

        try {
            $location->save();
            return redirect('/locations')->with('success', 'Location inserted successfully');
        } catch (\Throwable $th) {
            return redirect('/locations')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $location = location::findOrFail($id);
        return view('editLocation', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location' => 'required|string|max:255', // Validation rules
        ]);

        $location = location::findOrFail($id);
        $location->location = $request->location;

        try {
            $location->save();
            return redirect('/locations')->with('success', 'Location updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('locationList')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        $location = location::findOrFail($id);
        if ($location->delete()) {
            return redirect()->route('locationList')->with('success', 'Location deleted successfully');
        } else {
            return redirect()->route('locationList')->with('error', 'Failed to Delete Location');
        }
    }
}
