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
        $policyPdfData = Policy::where('id', $this->policy->id)->with(['user', 'branche', 'vehicle', 'premium'])->first();
        $namePdf = 'compulsory_car_insurance_' . $policyPdfData->policy_number . '_' . time() . '.pdf';
        $directoryPath = 'pdf/policies/compulsory-car-Insurance/';
        $pathPdf = $directoryPath . $namePdf;

        if (!Storage::exists($directoryPath)) {
            Storage::makeDirectory($directoryPath);
        }

        $pdf = PDF::loadView('policy.generatePdf.compulsoryInsurancePolicy', ['policy' => $policyPdfData])->save(storage_path('app/' . $pathPdf));

        $this->policy->pdf_path = '/storage/' . $pathPdf;
        $this->policy->save();
    }
}
