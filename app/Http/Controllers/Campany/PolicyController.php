<?php

namespace App\Http\Controllers\Campany;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Policy\CarInsurancePolicyRequest;
use App\Models\Company\Insurance;
use App\Models\Company\Policy;
use App\Models\Company\Vehicle;
use App\Traits\ApiResponseTrait;
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
            // Fetch the insurance or handle the case where it does not exist
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

            // Create Policy record
            $policy = Policy::create([
                'branche_id' => $user->branche_id,
                'insurance_id' => $insurance->id,
                'insurance_type_id' => null, // This might need a default or valid value
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
            ]);

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
