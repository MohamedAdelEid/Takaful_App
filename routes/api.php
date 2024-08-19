<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Company\PolicyController;
use App\Http\Controllers\Company\CountryController;
use App\Http\Controllers\Company\VehicleController;
use App\Http\Controllers\Company\AccidentController;
use App\Http\Controllers\Company\OrangeVisitedCountryController;

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
Route::post('send-reset-password', [AuthController::class, 'sendResetPassword']);
Route::post('reset-password', [AuthController::class, 'ResetPassword']);
Route::post('verify-email', [AuthController::class, 'verifyEmail']);

//New
Route::get('user-activation/{user}', [UserController::class, 'userActivation'])->middleware(['verify.token']);
Route::get('disable-user/{user}', [UserController::class, 'disableUser'])->middleware(['verify.token']);


Route::resource('note', NoteController::class)->middleware(['verify.token']);

/*------------------------------| Routes Policy |------------------------------*/
Route::group([
    'prefix' => 'policy',
    'middleware' => 'verify.token'
], function () {
    /*------------------------------| Route GetAllTypePolices |------------------------------*/
    Route::get('/', [PolicyController::class, 'index']);

    /*------------------------------| Route StoreCarInsurance |------------------------------*/
    Route::post('car-insurance', [PolicyController::class, 'storeCarInsurance']);

    /*------------------------------| Route StoreTravelerInsurance |------------------------------*/
    Route::post('traveler-insurance', [PolicyController::class, 'storeTravelerInsurance']);

    /*------------------------------| Route StoreTravelerInsurance |------------------------------*/
    Route::get('days-travel/{country}', [PolicyController::class, 'getDaysByCountry']);

    /*------------------------------| Route StoreOrangeCarInsurance |------------------------------*/
    Route::post('orange-car-insurance', [PolicyController::class, 'StoreOrangeCarInsurance']);

    //New
    Route::get('/get-mandatory-policies', [PolicyController::class, 'getMandatoryPolicies']);

    /*------------------------------| Route GetVisitedCountries in orange typeInsurance |------------------------------*/
    Route::get('orange-type-insurance/get-visited-countries', [OrangeVisitedCountryController::class, 'index']);

});

/*------------------------------| Routes Accidents |------------------------------*/
Route::group([
    'prefix' => 'accident',
    'middleware' => 'verify.token'
], function () {

    /*------------------------------| Create Accident |------------------------------*/
    Route::post('/', [AccidentController::class, 'store']);
    Route::get('/all-accident', [AccidentController::class, 'index']);

});


Route::get('get-available-cars', [VehicleController::class, 'geAllAvailableCars'])->middleware('verify.token');


/*------------------------------| Route Get All Countries |------------------------------*/
Route::get('countries', [CountryController::class, 'index']);

//New
Route::get('get-all-cars-model', [VehicleController::class, 'geAllVehiclesModel']);
Route::get('get-all-cars-colors', [VehicleController::class, 'geAllVehiclesColor']);



/*------------------------------| New |------------------------------*/

Route::get('num-of-paid-policies',[PolicyController::class , 'numOfPaidPolicies'])->middleware('verify.token');


Route::get('search',[SearchController::class , 'search'])->middleware('verify.token');


Route::get('/all-accident', [AccidentController::class, 'index']);
