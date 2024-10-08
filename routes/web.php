<?php

use App\Helper\Currency;
use App\Models\Company\Country;
use App\Models\User\Traveler;
use App\Models\User\Trip;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\Models\Company\Policy;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Company\OrangeVisitedCountry;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Medical_InsuranceController;


// use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;


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

});

Route::get(
    '/test',
    function () {
        $policy = Policy::find(1);
    }
);

Route::post('/send-insurance-email', [Medical_InsuranceController::class, 'sendInsuranceEmail']);
Route::get('/test-insurance-email', function () {
    return view('test');
});