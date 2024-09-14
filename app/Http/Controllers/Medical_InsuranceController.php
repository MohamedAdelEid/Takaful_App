<?php

namespace App\Http\Controllers;

use App\Mail\InsuranceMail;
use App\Models\Medical_insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Medical_InsuranceController extends Controller
{
    public function sendInsuranceEmail(Request $request)
    {
        $insuranceId = $request->input('insurance_id');
        $insuranceType = $request->input('insurance_type');

        if ($insuranceType === 'medical') {
            $insurance = Medical_insurance::find($insuranceId);
        } else {
            $insurance = LifeInsurance::find($insuranceId);
        }

        if ($insurance) {
            Mail::to($insurance->email)->send(new InsuranceMail($insuranceType, $insurance->full_name));
            session()->flash('success', 'Email sent successfully!');
        } else {
            session()->flash('error', 'Insurance not found!');
        }

        return redirect()->back(); 
    }
}
