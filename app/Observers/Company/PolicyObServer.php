<?php

namespace App\Observers\Company;

use App\Models\Company\InsuranceType;
use App\Models\Company\Policy;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PolicyObServer
{
    /**
     * Handle the policy "created" event.
     */
    public function creating(Policy $policy, $type, $management, $insuranceTypeId): void
    {
        $type = $type ?? 'local';

        // get year policy
        $year = Carbon::now()->year;
        $lastTwoDigitYear = substr($year, -2);

        // get month policy
        $month = Carbon::now()->month;
        $paddingMonth = str_pad($month, 2, '0', STR_PAD_LEFT);

        if ($type == "local") {

            // get branche_number for user will make policy from this branche 
            $brancheNumber = Auth::user()->branche->branche_number;
            $paddingBrancheNumber = str_pad($brancheNumber, 2, '0', STR_PAD_LEFT);

            //get insurance_type_number
            $insuranceTypeNumber = InsuranceType::where('id', $insuranceTypeId)->value('insurance_type_number');
            $insuranceTypeNumber = $insuranceTypeNumber ?? $insuranceTypeId;

            /*
             * generate number it consists of four numbers for each branche special-number start from start month
             */
            // => get last policy for this branche
            $lastPolicy = Policy::where('branche_id', '=', $brancheNumber)
                ->where('policy_number', 'like', "%$management%")
                ->whereMonth('created_at', $month)
                ->latest()
                ->first();

            if ($lastPolicy) {
                $numberLastPolicy = $lastPolicy->policy_number;
                $serialNumber = (int) substr($numberLastPolicy, -4) + 1;
                $paddingSerialNumber = str_pad($serialNumber, 4, '0', STR_PAD_LEFT);
            } else {
                $paddingSerialNumber = "0001";
            }

            // 01 24 08 GAC 509 0119
            $policyNumber = $paddingBrancheNumber . $lastTwoDigitYear . $paddingMonth . $management . $insuranceTypeNumber . $paddingSerialNumber;
            $policy->policy_number = $policyNumber;

        } else if ('international') {

            // LBY/24/#######
            $policyNumber = config('app.country') . $lastTwoDigitYear . rand(1000000, 9999999);
            $checkPolicyNumber = Policy::where('policy_number', $policyNumber)->first();
            if ($checkPolicyNumber) {
                $policyNumber = config('app.country') . $lastTwoDigitYear . rand(1000000, 9999999);
            }
            $policy->policy_number = $policyNumber;

        }
    }


    /**
     * Handle the policy "updated" event.
     */
    public function updated(Policy $policy): void
    {
        //
    }

    /**
     * Handle the policy "deleted" event.
     */
    public function deleted(Policy $policy): void
    {
        //
    }

    /**
     * Handle the policy "restored" event.
     */
    public function restored(Policy $policy): void
    {
        //
    }

    /**
     * Handle the policy "force deleted" event.
     */
    public function forceDeleted(Policy $policy): void
    {
        //
    }
}
