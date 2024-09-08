<?php

namespace App\Jobs\Policy;

use App\Models\Company\Policy;
use App\Models\User\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GeneratePolicyTravelInsurancePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $trip;
    protected $imagePassport;

    /**
     * Create a new job instance.
     *
     * @param Trip $trip
     */
    public function __construct(Trip $trip, $imagePassport)
    {
        $this->trip = $trip;  // Corrected assignment
        $this->imagePassport = $imagePassport;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $trip = Trip::where('id', $this->trip->id)
                ->with(['traveler.user.branche', 'dependents', 'policy.premium'])
                ->first();

            $namePdf = 'TRAVELER-INSURANCE-' . $trip->policy->policy_number . '-' . time() . '.pdf';
            $mainDirectoryPath = 'pdf/policies/traveler-Insurance/';
            $pathPdf = $mainDirectoryPath . $namePdf;

            if (!Storage::disk('public')->exists($mainDirectoryPath)) {
                Storage::disk('public')->makeDirectory($mainDirectoryPath);
            }

            // Generate Qrcode for link pdf
            $qrCode = QrCode::format('png')->size(200)->generate(config('app.url') . '/public/storage/' . $pathPdf);
            // Convert PNG to base64
            $qrCodeBase64 = base64_encode($qrCode);

            if ($this->imagePassport) {
                $imagePassport = config('app.url') . '/public/storage/' . $this->imagePassport;
            }

            $pdf = PDF::loadView('policy.generatePdf.travelInsurancePolicy', [
                'trip' => $trip,
                'qrCode' => $qrCodeBase64,
                'imagePassport' => $imagePassport
            ])
                ->save(storage_path('app/public/' . $pathPdf));

            $trip->policy->pdf_path = $pathPdf;
            $trip->policy->save();
        } catch (\Exception $e) {
            \Log::error('PDF Generation failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
