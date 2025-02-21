<?php

use App\Http\Controllers\ApiDataController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard'); // Assuming 'dashboard' is the name of your dashboard route
    }

    // If the user is not logged in, you can redirect to the login page or the default landing page
    return redirect()->route('login'); // Adjust to the route you prefer});
});

Route::post('/tenantData', [ApiDataController::class, 'getData'])->name('tenantData');
Route::post('/fetchAndInsert', [ApiDataController::class, 'fetchAndInsertData']);
Route::get('/getTenantData', [ApiDataController::class, 'getTenantData'])->name('getTenantData');
Route::get('/chart-summary', [ApiDataController::class, 'getChartSummary']);
Route::get('/getbuildingManagers', [ApiDataController::class, 'getBuildingManagerData'])->name('getBuildingManagers');
Route::get('/managerDetail/{id}', [ApiDataController::class, 'getBuildingManagerDetail']);

Route::get('/building-menagers', function () {
    return view('buildingManagerList');
})->name('buildingManager');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [ApiDataController::class, 'showDashboard'])->name('dashboard');


    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});
