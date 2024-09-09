<?php

use App\Http\Controllers\Company\CoverageAreaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ZoomController;
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

    /*------------------------------| Route number Polices |------------------------------*/
    Route::get('/number', [PolicyController::class, 'totolNumber']);

    /*------------------------------| Route StoreCarInsurance |------------------------------*/
    Route::post('car-insurance', [PolicyController::class, 'storeCarInsurance']);

    /*------------------------------| Route StoreTravelerInsurance |------------------------------*/
    Route::post('traveler-insurance', [PolicyController::class, 'storeTravelerInsurance']);

    /*------------------------------| Route StoreTravelerInsurance |------------------------------*/
    Route::get('days-travel/{country}', [PolicyController::class, 'getDaysByCountry']);

    /*------------------------------| Route StoreOrangeCarInsurance |------------------------------*/
    Route::post('orange-car-insurance', [PolicyController::class, 'StoreOrangeCarInsurance']);

    /*------------------------------| Route GetAllCompulsoryPolicies |------------------------------*/
    Route::get('get-compulsory-policies', [PolicyController::class, 'getMandatoryPolicies']);

    /*------------------------------| Route GetVisitedCountries in orange typeInsurance |------------------------------*/
    Route::get('orange-type-insurance/get-visited-countries', [OrangeVisitedCountryController::class, 'index']);

    /*------------------------------| Route Policies Active |------------------------------*/
    Route::get('num-of-paid-policies', [PolicyController::class, 'numOfPaidPolicies']);

});

/*------------------------------| Route Get All Coverage Areas |------------------------------*/
Route::get('coverage-area', [CoverageAreaController::class, 'index'])->middleware('verify.token');


/*------------------------------| Routes Accidents |------------------------------*/
Route::group([
    'prefix' => 'accident',
    'middleware' => 'verify.token'
], function () {

    /*------------------------------| Create Accident |------------------------------*/
    Route::post('/', [AccidentController::class, 'store']);
    Route::get('/all', [AccidentController::class, 'index']);

});

/*------------------------------| Get AvailableCars |------------------------------*/
Route::get('get-available-cars', [VehicleController::class, 'geAllAvailableCars'])->middleware('verify.token');

/*------------------------------| Route Get All Countries |------------------------------*/
Route::get('countries', [CountryController::class, 'index'])->middleware('verify.token');

/*------------------------------| Routes Vehicle |------------------------------*/
Route::group([
    'prefix' => 'vehicle',
    'middleware' => 'verify.token'
], function () {

    /*------------------------------| Route GetModelVehicle |------------------------------*/
    Route::get('get-all-vehicle-model', [VehicleController::class, 'geAllVehiclesModel']);

    /*------------------------------| Route GetColorVehicle |------------------------------*/
    Route::get('get-all-vehicle-colors', [VehicleController::class, 'geAllVehiclesColor']);
});


/*------------------------------| New |------------------------------*/

Route::get('num-of-paid-policies', [PolicyController::class, 'numOfPaidPolicies'])->middleware('verify.token');


Route::get('search', [SearchController::class, 'search'])->middleware('verify.token');


Route::get('/all-accident', [AccidentController::class, 'index']);




Route::get('search-policies', [SearchController::class, 'search'])->middleware('verify.token');

Route::get('zoom/meetings', [ZoomController::class, 'listMeetings']);
Route::post('zoom/meetings', [ZoomController::class, 'createMeeting']);

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    $data = ['message' => 'This is a test email from Laravel'];
    Mail::raw($data['message'], function($message) {
        $message->to('sa3doni2714@gmail.com') 
                ->subject('Test Email from Laravel')
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    });

    return 'Email sent!';
});
