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

class GeneratePolicyOrangeCarInsurancePdf implements ShouldQueue
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
            // Retrieve the policy with the related data
            $policy = Policy::where('id', $this->policy->id)
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

            $policy->pdf_path = $pathPdf;
            $policy->save();

        } catch (\Exception $e) {
            // Log the error and rethrow the exception
            \Log::error('PDF Generation failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
