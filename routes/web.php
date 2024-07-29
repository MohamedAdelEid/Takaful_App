<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\Models\Company\Policy;

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

    $month = Carbon::now()->month;

    // generate number it consists of four numbers for each branche special-number start from start month

    // get last policy for this branche
    $lastPolicy = Policy::where('branche_id', '=', 1)->whereMonth('created_at', $month)->latest()->first();

    if ($lastPolicy) {
        $numberLastPolicy = $lastPolicy->policy_number;
        $serialNumber = (int) substr($numberLastPolicy, -4);
        $serialNumber = "000" . $serialNumber + 1;
    } else {
        $serialNumber = "0001";
    }

    dd($serialNumber);
});
