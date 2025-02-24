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
Route::get('/getbuildingManagers', [ApiDataController::class, 'showBuildingManagers'])->name('showBuildingManagers');
Route::get('/managerDetail/{id}', [ApiDataController::class, 'getBuildingManagerDetail']);
Route::get('/manager/{id}/edit', [ApiDataController::class, 'edit'])->name('edit');
Route::put('/users/{id}', [ApiDataController::class, 'update'])->name('update');
Route::delete('/users/{id}/delete', [ApiDataController::class, 'delete'])->name('delete');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [ApiDataController::class, 'showDashboard'])->name('dashboard');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});
