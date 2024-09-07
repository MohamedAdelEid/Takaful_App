<?php

namespace App\Jobs\Policy;

use App\Models\Company\Policy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GeneratePolicyCarInsurancePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $policy;

    /**
     * Create a new job instance.
     */
    public function __construct(Policy $policy)
    {
        $this->policy = $policy;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $policy = Policy::where('id', $this->policy->id)
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

            $pdf = PDF::loadView('policy.generatePdf.compulsoryInsurancePolicy', [
                'policy' => $policy,
                'qrCode' => $qrCodeBase64
            ])
                ->save(storage_path('app/public/' . $pathPdf));

            $policy->pdf_path = $pathPdf;
            $policy->save();
        } catch (\Exception $e) {
            \Log::error('PDF Generation failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
