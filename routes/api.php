<?php

use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('vaccinations', [VaccinationController::class, 'getAll']);
Route::get('vaccinations/{id}', [VaccinationController::class, 'getById']);
Route::get('vaccinations/location/{locationId}', [VaccinationController::class, 'getByLocation']);

Route::post('vaccinations', [VaccinationController::class, 'save']);

Route::put('vaccinations/{id}', [VaccinationController::class, 'update']);

Route::delete('vaccinations/{id}', [VaccinationController::class, 'delete']);

/**
 * users
 */
Route::get('users', [UserController::class, 'getAll']);

/**
 * locations
 */
Route::get('locations', [LocationController::class, 'getAll']);
