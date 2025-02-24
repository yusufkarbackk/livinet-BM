<?php

namespace App\Http\Controllers;

use App\Models\location;
use App\Models\TenantData;
use App\Models\User;
use App\Services\DataServices;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Mechanisms\DataStore;

class ApiDataController extends Controller
{

    public function fetchAndInsertData() // run this controller everyday
    {
        $dataService = new DataServices();
        $dataService->fetchAndInsertData();
    }

    public function showDashboard()
    {
        $dataService = new DataServices();
        $data = $dataService->getTenantData();
        return view('dashboard', ['tenants' => $data]);
    }

    public function showBuildingManagers()
    {
        $data = User::where('role', 'bm')->get();
        // Log::info('User :', $data->toArray());

        return view('buildingManagerList', ['managers' => $data]);
    }

    public function getBuildingManagerDetail($userId)
    {
        // Get the user with their locations
        $user = User::with('locations')->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        return view('managerDetail', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Get all locations
        $locations = location::all();

        // Get locations the user already has
        $userLocationIds = $user->locations()->pluck('locations.id')->toArray();

        return view('editBuildingManager', compact('user', 'locations', 'userLocationIds'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Ensure locations exist in request, else keep existing ones
        $selectedLocations = $request->input('locations', []);

        try {
            if (!empty($selectedLocations)) {
                $user->locations()->sync($selectedLocations); // Update user locations
            } else {
                // If no locations are selected, retain old ones to prevent deletion
                $user->locations()->sync($user->locations()->pluck('locations.id')->toArray());
            }
            return redirect()->route('dashboard')->with('success', 'User updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return redirect()->route('dashboard')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('dashboard')->with('error', 'Failed to Delete User');
        }
    }


    public function getChartSummary()
    {
        $user = Auth::user();
        if ($user->role == 'bm') {
            // Get the location IDs from the pivot table
            $userLocationIds = DB::table('location_user')
                ->where('user_id', $user->id)
                ->pluck('location_id');

            $userLocationName = DB::table('locations')
                ->whereIn('id', $userLocationIds)
                ->pluck('location');

            //Log::info('User Location :', $userLocationName->toArray());

            $data = DB::table('tenant_data')
                ->whereIn('location', $userLocationName)
                ->get();

            $totalTenants = $data->count();
            $activeServices = $data->where('status', 'Active')->count();
            return response()->json([
                'total_tenants' => $totalTenants,
                'active_services' => $activeServices,
            ]);
        } else {
            // Count total tenants
            $totalTenants = TenantData::count();

            // Count active services (assuming 'status' column tracks active services)
            $activeServices = TenantData::where('status', 'Active')->count();

            // Return the counts as JSON
            return response()->json([
                'total_tenants' => $totalTenants,
                'active_services' => $activeServices,
            ]);
        }
    }
}
