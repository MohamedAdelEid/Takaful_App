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

    $trip = Trip::with(['traveler.user.branche', 'dependents', 'policy.premium'])->latest()->first();
            $namePdf = 'TRAVELER-INSURANCE-' . $trip->policy->policy_number . '-' . time() . '.pdf';
            $mainDirectoryPath = 'pdf/policies/traveler-Insurance/';
            $pathPdf = $mainDirectoryPath . $namePdf;

            if (!Storage::exists($mainDirectoryPath)) {
                Storage::makeDirectory($mainDirectoryPath);
            }

            $pdf = PDF::loadView('policy.generatePdf.travelInsurancePolicy', ['trip' => $trip])
                ->save(storage_path('app/' . $pathPdf));

            $trip->policy->pdf_path = '/storage/' . $pathPdf;
            $trip->policy->save();

    // $trip = Trip::with(['traveler.user.branche', 'dependents', 'policy.premium'])->latest()->first();
    // // $co = new Traveler;
    // // // dd($policy->user->traveler->dependents->count() == 1);
    // $pdf = PDF::loadView('policy.generatePdf.travelInsurancePolicy', compact('trip'));
    // return $pdf->stream();
});

Route::get(
    '/test',
    function () {
        $policy = Policy::find(1);
    }
);