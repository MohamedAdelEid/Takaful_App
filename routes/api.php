<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Company\CountryController;
use App\Http\Controllers\Company\PolicyController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware(['verify.token']);
Route::put('change-password', [AuthController::class, 'changePassword'])->middleware(['verify.token']);
Route::get('profile', [AuthController::class, 'profile'])->middleware(['verify.token']);

Route::resource('note', NoteController::class)->middleware(['verify.token']);

/*------------------------------| Routes Policy |------------------------------*/
Route::group([
    'prefix' => 'policy',
    'middleware' => 'verify.token'
], function () {

    /*------------------------------| Route StoreCarInsurance |------------------------------*/
    Route::post('car-insurance', [PolicyController::class, 'storeCarInsurance']);

    /*------------------------------| Route StoreTravelerInsurance |------------------------------*/
    Route::post('traveler-insurance', [PolicyController::class, 'storeTravelerInsurance']);

    /*------------------------------| Route StoreTravelerInsurance |------------------------------*/
    Route::get('days-travel/{country}', [PolicyController::class, 'getDaysByCountry']);

    /*------------------------------| Route GetAllTypePolices |------------------------------*/
    Route::get('/', [PolicyController::class, 'index']);

});

/*------------------------------| Route Get All Countries |------------------------------*/
Route::get('countries', [CountryController::class, 'index']);

