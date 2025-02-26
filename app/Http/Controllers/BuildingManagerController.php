<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Hash;

class BuildingManagerController extends Controller
{
    use PasswordValidationRules;

    public function registerBM(Request $request)
    {

        $input = $request->all();

        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'locations' => ['array', 'required'],
            'locations.*' => ['exists:locations,id', 'required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        try {
            $user = User::create([
                'email' => $input['email'],
                'location' => $input['locations'],
                'password' => Hash::make($input['password']),
            ]);
            if (!empty($input['locations'])) {
                $user->locations()->attach($input['locations']);
            }
            return redirect()->route('dashboard')->with('success', 'Building Manager registered successfully');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', $th->getMessage());
        }
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
}
