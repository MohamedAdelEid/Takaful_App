<?php

namespace App\Http\Controllers\Campany;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Policy\CarInsurancePolicyRequest;
use App\Models\Company\Insurance;
use App\Models\Company\Policy;
use App\Models\Company\Vehicle;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PolicyController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCarInsurance(CarInsurancePolicyRequest $request)
    {
        try {
            // Get Car Insurance "insurance_number" = 100 
            $insurance = Insurance::where('insurance_number', '100')->first();

            if (!$insurance) {
                return $this->errorResponse(['message' => 'Insurance not found'], 404);
            }

            // Ensure the user is authenticated
            $user = Auth::user();

            if (!$user) {
                return $this->errorResponse(['message' => 'User not authenticated'], 401);
            }

            // Set management property for Policy model
            Policy::$management = 'MTR';
            Policy::$insuranceTypeId = $request->insurance_type_id;

            // Create Policy record
            $policy = Policy::create([
                'branche_id' => $user->branche_id,
                'insurance_id' => $insurance->id,
                'insurance_type_id' => $request->insurance_type_id, // This might need a default or valid value
                'user_id' => $user->id,
                'name' => 'وثيقة تأمين سيارة',
                'start_date' => Carbon::now()->addDay(), // Adjust as needed
                'end_date' => Carbon::now()->addYear()->addDay(),
            ]);

            // Create Vehicle record
            $vehicle = Vehicle::create([
                'user_id' => $user->id,
                'policy_id' => $policy->id,
                'type' => $request->car_type,
                'model' => $request->car_model,
                'engine_hours_power' => $request->car_power,
                'number_of_seats' => $request->car_number_of_seats,
                'year_of_manufacturing' => $request->car_year_of_manufacturing,
                'plate_number' => $request->car_plate_number,
                'chassis_number' => $request->car_chassis_number,
                'color' => $request->car_color,
                'vehicle_place_of_registration' => $request->car_governorate,
            ])->setHidden([
                        'user_id',
                        'policy_id'
                    ]);

            // store user_id and insurance_type_id in table insurance_type_user => becouse if know user is vip or no
            $user->insuranceTypes()->sync($request->insurance_type_id);

            // Prepare response data
            $responseData = [
                'policy' => $policy,
                'vehicle' => $vehicle,
            ];

            return $this->successResponse($responseData, 'Policy Car Insurance Created successfully', 200);
        } catch (\Exception $e) {
            // Log the detailed error message and stack trace
            \Log::error('Error storing car insurance: ' . $e->getMessage(), ['exception' => $e]);

            return $this->errorResponse(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function storeTravelersInsurance(Request $request)
    {
        try {
            // Get Travelers Insurance "insurance_number" = 509
            $insurance = Insurance::where('insurance_number', '509')->first();

            if (!$insurance) {
                return $this->errorResponse(['message' => 'Insurance not found'], 404);
            }

            // Ensure the user is authenticated
            $user = Auth::user();

            if (!$user) {
                return $this->errorResponse(['message' => 'User not authenticated'], 401);
            }

            // Set management property for Policy model
            Policy::$management = 'GAC';
            Policy::$insuranceTypeId = $insurance->insurance_number;

            // Create Policy record
            $policy = Policy::create([
                'branche_id' => $user->branche_id,
                'insurance_id' => $insurance->id,
                'insurance_type_id' => null, // This might need a default or valid value
                'user_id' => $user->id,
                'name' => 'وثيقة تأمين المسافرين',
                'start_date' => $request->start_date, // Adjust as needed
                'end_date' => '',
            ]);


        } catch (Exception $e) {
            return $this->errorResponse(['massage' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
