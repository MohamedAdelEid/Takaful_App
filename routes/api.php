<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Campany\PolicyController;
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

Route::resource('note', NoteController::class)->middleware(['verify.token']);

Route::group([
    'prefix' => 'policy'
], function () {

    /*------------------------------| Routes Policy |------------------------------*/
    Route::post('car-insurance', [PolicyController::class, 'storeCarInsurance'])->middleware(['verify.token']);

});
