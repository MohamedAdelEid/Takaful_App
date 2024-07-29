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
    public function creating(Policy $policy, $management , $insuranceTypeId): void
    {
        // get branche_number for user will make policy from this branche 
        $brancheNumber = Auth::user()->branche->branche_number;
        $formattedNumber = str_pad($brancheNumber, 2, '0', STR_PAD_LEFT);

        // get year policy
        $year = Carbon::now()->year;
        $lastTwoDigitYear = substr($year, -2);

        // get month policy
        $month = Carbon::now()->month;

        //get insurance_type_number
        $insuranceTypeNumber = InsuranceType::where('id' , $insuranceTypeId)->value('insurance_type_number');

        // generate number it consists of four numbers for each branche special-number start from start month

        // get last policy for this branche
        $lastPolicy = Policy::where('branche_id', '=', $brancheNumber)->whereMonth('created_at', $month)->latest()->first();
        $today = Carbon::today()->day;

        if ($lastPolicy) {
            $numberLastPolicy = $lastPolicy->policy_number;
            $serialNumber = (int) substr($numberLastPolicy, -4);
            $serialNumber = "000" . $serialNumber + 1;
        } else {
            $serialNumber = "0001";
        }

        $policy->policy_number = $formattedNumber . $lastTwoDigitYear . $month . $management . $insuranceTypeNumber . $serialNumber;
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
