<?php

use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AuthController;

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

Route::group(['middleware' => ['api', 'auth.jwt']], function(){
    Route::get('vaccinations', [VaccinationController::class, 'getAll']);
    Route::get('vaccinations/{id}', [VaccinationController::class, 'getById']);
    Route::post('vaccinations', [VaccinationController::class, 'save']);
    Route::put('vaccinations/{id}', [VaccinationController::class, 'update']);
    Route::delete('vaccinations/{id}', [VaccinationController::class, 'delete']);
    Route::get('users/signedup/{vaccinationId}', [UserController::class, 'getPatientsByVaccination']);

    /**
     * users
     */
    Route::get('users', [UserController::class, 'getAll']);
    Route::get('users/{id}', [UserController::class, 'getById']);
    Route::put('users/setVaccinationStatus/{id}', [UserController::class, 'setVaccinationStatus']);
    Route::put('users/signup', [UserController::class, 'setVaccinationAppointment']);
    Route::put('users/{id}/cancelAppointment', [UserController::class, 'cancelAppointment']);
    Route::post('auth/logout', [AuthController::class,'logout']);

    Route::post('users', [UserController::class, 'save']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'delete']);

    /**
     * locations
     */
    Route::post('locations', [LocationController::class, 'save']);
    Route::put('locations/{id}', [LocationController::class, 'update']);
    Route::delete('locations/{id}', [LocationController::class, 'delete']);
});

Route::get('vaccinations/location/{locationId}', [VaccinationController::class, 'getByLocation']);

/**
 * locations
 */
Route::get('locations', [LocationController::class, 'getAll']);
Route::get('locations/{id}', [LocationController::class, 'getById']);

/**
 * login
 */
Route::post('auth/login', [AuthController::class,'login']);
