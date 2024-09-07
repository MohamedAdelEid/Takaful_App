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
    $policy = Policy::latest()
        ->with(['user', 'branche', 'vehicle', 'premium'])
        ->first();

    // generate path 
    $namePdf = 'COMPULSORY-CAR-INSURANCE-' . $policy->policy_number . '_' . time() . '.pdf';
    $directoryPath = 'pdf/policies/compulsory-car-Insurance/';
    $pathPdf = $directoryPath . $namePdf;

    if (!Storage::disk('public')->exists($directoryPath)) {
        Storage::disk('public')->makeDirectory($directoryPath);
    }

    // Generate Qrcode for link pdf
    $qrCode = QrCode::format('png')->size(200)->generate(config('app.url') . '/public/storage/' . $pathPdf);
    // Convert PNG to base64
    $qrCodeBase64 = base64_encode($qrCode);

    $pdf = PDF::loadView('policy.generatePdf.compulsoryInsurancePolicy', ['policy' => $policy , 'qrCode' => $qrCodeBase64])
        ->save(storage_path('app/public/' . $pathPdf));

        $policy->pdf_path = $pathPdf;
        $policy->save();
});

Route::get(
    '/test',
    function () {
        $policy = Policy::find(1);
    }
);