<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Company\PolicyController;
use App\Http\Controllers\Company\CountryController;
use App\Http\Controllers\Company\VehicleController;

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
Route::post('delete-user', [AuthController::class, 'deleteUser'])->middleware(['verify.token']);
Route::put('change-password', [AuthController::class, 'changePassword'])->middleware(['verify.token']);
Route::get('profile', [AuthController::class, 'profile'])->middleware(['verify.token']);
Route::get('users', [UserController::class, 'getUsers'])->middleware(['verify.token']);
Route::post('send-reset-password',[AuthController::class, 'sendResetPassword']);
Route::post('reset-password',[AuthController::class, 'ResetPassword']);

 //New
Route::get('user-activation/{user}', [UserController::class, 'userActivation'])->middleware(['verify.token']);
Route::get('disable-user/{user}', [UserController::class, 'disableUser'])->middleware(['verify.token']);


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
    //New
    Route::get('/get-mandatory-policies', [PolicyController::class, 'getMandatoryPolicies']);

});

/*------------------------------| Route Get All Countries |------------------------------*/
Route::get('countries', [CountryController::class, 'index']);

 //New
Route::get('get-all-cars-model',[VehicleController::class,'geAllVehiclesModel']);
Route::get('get-all-cars-colors',[VehicleController::class,'geAllVehiclesColor']);