<?php

namespace App\Http\Controllers;

use App\Models\TenantData;
use App\Models\User;
use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiDataController extends Controller
{
    public function getData()
    {
        $url = env("TENANT_DATA_URL");

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options for POST request
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);  // Set method to POST

        // Disable SSL verification (not recommended for production)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable peer SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // Disable host SSL verification

        // Execute the POST request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            return response()->json(['error' => 'Request failed', 'message' => $error], 500);
        }

        // Close the cURL session
        curl_close($ch);

        // Return the response
        return response()->json(json_decode($response, true));
    }

    public function fetchAndInsertData() // run this controller everyday
    {
        $locations = location::all();
        $response = $this->getData();
        //dd($response);
        if ($response->isSuccessful()) {
            $data = $response->getData(true);
            if (isset($data['services']) && is_array($data['services'])) {

                foreach ($data['services'] as &$tenantData) {
                    $tenantLocation = strtoupper($tenantData['location']);

                    if (empty($tenantLocation)) {
                        $tenantData["locationId"] = 0;
                    } else {
                        // Fetch all locations
                        $locations = DB::table('locations')->pluck('location', 'id');

                        $bestMatchId = 0;
                        $bestScore = 999; // Higher means worse match

                        foreach ($locations as $id => $locationName) {
                            $levDistance = levenshtein(strtoupper($locationName), $tenantLocation);

                            if ($levDistance < $bestScore) { // Find the closest match
                                $bestScore = $levDistance;
                                $bestMatchId = $id;
                            }
                        }

                        // Allow a max typo difference of 3 characters
                        $tenantData["locationId"] = ($bestScore <= 3) ? $bestMatchId : 0;
                    }
                }

                TenantData::truncate(); // Deletes all rows in the table
                TenantData::insert($data['services']); // Bulk insert
                return response()->json(['message' => 'Data inserted successfully!']);
            }

            return response()->json(['error' => 'No valid data to insert'], 400);
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }

    public function getTenantData()
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
                ->paginate(10);

            return $data;
        } else {
            $data = TenantData::paginate(10);
            return $data;
        }
    }

    public function showDashboard()
    {
        $data = $this->getTenantData();
        return view('dashboard', ['tenants' => $data]);
    }

    public function getBuildingManagerData()
    {
        $data = User::where('role', 'bm')->get();
        Log::info('User :', $data->toArray());

        return response()->json($data);
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
