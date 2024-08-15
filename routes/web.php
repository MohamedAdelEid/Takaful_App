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
            // Retrieve the policy with the related data
            $policy = Policy::latest()
                ->with(['user', 'branche', 'vehicle', 'premium', 'orangeVisitedCountries', 'availableCars'])
                ->firstOrFail();

            // Generate the PDF file path and directory
            $namePdf = 'ORANGE-CAR-INSURANCE-' . $policy->policy_number . '_' . time() . '.pdf';
            $directoryPath = 'pdf/policies/orange-car-Insurance/';
            $pathPdf = $directoryPath . $namePdf;

            // Ensure the directory exists
            if (!Storage::disk('public')->exists($directoryPath)) {
                Storage::disk('public')->makeDirectory($directoryPath);
            }

            // Generate the PDF and save it to the storage
            $pdf = PDF::loadView('policy.generatePdf.orangeCarInsurancePolicy', ['policy' => $policy])
                ->save(storage_path('app/public/' . $pathPdf));

            // Update the policy with the PDF path
            $policy->update(['pdf_path' => $pathPdf]);
});

Route::get(
    '/test',
    function () {
        $policy = Policy::find(1);
    }
);