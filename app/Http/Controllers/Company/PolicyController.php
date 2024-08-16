<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Policy\CarInsuranceRequest;
use App\Http\Requests\Company\Policy\OrangeCarInsuranceRequest;
use App\Http\Requests\Company\Policy\TravelerInsuranceRequest;
use App\Jobs\Policy\GeneratePolicyCarInsurancePdf;
use App\Jobs\Policy\GeneratePolicyOrangeCarInsurancePdf;
use App\Jobs\Policy\GeneratePolicyTravelInsurancePdf;
use App\Models\AvailableCar;
use App\Models\Company\Insurance;
use App\Models\Company\InsuranceType;
use App\Models\Company\OrangeVisitedCountry;
use App\Models\Company\Policy;
use App\Models\Company\Premium;
use App\Models\Company\Vehicle;
use App\Models\Company\Country;
use App\Models\User\Dependent;
use App\Models\User\Traveler;
use App\Models\User\Trip;
use App\Traits\ApiResponseTrait;
use App\Helper\Country as CountryHelper;
use App\Helper\Policy as PolicyHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

class PolicyController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $policies = Policy::get();

            $policies->each(function ($policy) {
                $policy->type_policy = $policy->insurance->name;
                $policy->name_user = $policy->user->first_name . ' ' . $policy->user->last_name;
                $policy->branche_name = $policy->branche->name;
                unset($policy->insurance);
                unset($policy->branche_id);
                unset($policy->branche);
                unset($policy->user);
            });

            return $this->successResponse($policies, 'Policies retrieved successfully!', 200);
        } catch (Exception $e) {
            return $this->errorResponse(['An error occurred'], 500);
        }
    }

    // store compulsory-car-insurance
    public function storeCarInsurance(CarInsuranceRequest $request)
    {
        try {
            // Get Car Insurance "insurance_number" = 100 
            $insurance = Insurance::where('insurance_number', '100')->first();

            if (!$insurance) {
                return $this->errorResponse(['message' => 'Insurance not found'], 404);
            } else if ($insurance->status != 'active') {
                return $this->errorResponse(['message' => 'Insurance is inactive'], 404);
            }

            // Get Car Insurance_type "insurance_number" = 103 
            $insuranceType = InsuranceType::where('insurance_type_number', '103')->first();

            if (!$insuranceType) {
                return $this->errorResponse(['message' => 'insurance Type not found'], 404);
            } else if ($insuranceType->status != 'active') {
                return $this->errorResponse(['message' => 'Insurance Type is inactive'], 404);
            }

            // Ensure the user is authenticated
            $user = Auth::user();

            if (!$user) {
                return $this->errorResponse(['message' => 'User not authenticated'], 401);
            }

            // Set management property for Policy model
            Policy::$management = 'MTR';
            Policy::$insuranceTypeId = $insuranceType->id;

            // Create Policy record
            $policy = Policy::create([
                'branche_id' => $user->branche_id,
                'insurance_id' => $insurance->id,
                'insurance_type_id' => $insuranceType->id, // This might need a default or valid value
                'user_id' => $user->id,
                'start_date' => Carbon::now()->addDay(),
                'end_date' => Carbon::now()->addYear(),
            ]);

            // Get the premium details based on the car power
            $premuim = PolicyHelper::getPremiumByPowerCar($request->car_power);
            $premuim['policy_id'] = $policy->id;
            $premuim = Premium::create($premuim);

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
                'purpose_of_license' => 'خاصة',
            ])->setHidden([
                        'user_id',
                        'policy_id'
                    ]);

            // store user_id and insurance_type_id in table insurance_type_user => becouse if know user is vip or no
            $user->insuranceTypes()->attach($insuranceType->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // store user_id and insurance_id in table insurance_user => becouse Relation m - m 
            $user->insurances()->attach($insurance->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            /* 
             * Generate pdf for car insurance policy
             */
            // Dispatch the job for PDF generation
            GeneratePolicyCarInsurancePdf::dispatch($policy);

            // Prepare response data
            $responseData = [
                'policy' => $policy,
                'premuim' => $premuim,
                'vehicle' => $vehicle,
            ];

            return $this->successResponse($responseData, 'Policy Car Insurance Created successfully', 200);
        } catch (Exception $e) {
            // Log the detailed error message and stack trace
            \Log::error('Error storing car insurance: ' . $e->getMessage(), ['exception' => $e]);

            return $this->errorResponse(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    // store traveler-insurance
    public function storeTravelerInsurance(TravelerInsuranceRequest $request)
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

            $countryId = $request->country_id;
            $days = $request->days;
            $startDate = Carbon::parse($request->start_date);
            $endDate = $startDate->copy()->addDays($days);

            // Create Policy record
            $policy = Policy::create([
                'branche_id' => $user->branche_id,
                'insurance_id' => $insurance->id,
                'insurance_type_id' => null, // this policy not have insurance_type
                'user_id' => $user->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            // store user_id and insurance_id in table insurance_user => becouse Relation m - m 
            $user->insurances()->attach($insurance->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Create or update traveler data
            $traveler = Traveler::where('user_id', $user->id)->first();
            if (!$traveler) {
                $traveler = Traveler::create([
                    'user_id' => $user->id,
                    'passport_number' => $request->passport_number,
                    'name_in_passport' => $request->name_in_passport,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                ]);
            }

            // create trip
            $trip = Trip::create([
                'traveler_id' => $traveler->id,
                'country_id' => $countryId,
                'policy_id' => $policy->id,
                'days' => $days
            ]);


            // Create Premiums for traveler insurance
            $premium = PolicyHelper::getPremiumsTravelerInsurance($days, $countryId, $traveler);
            $premium['policy_id'] = $policy->id;
            Premium::create($premium);

            // Create dependents department[i][ name , passport ,.....]
            if ($request->has('dependents')) {
                foreach ($request->dependents as $dependentData) {

                    $dependent = Dependent::where('passport_number', $dependentData['passport_number'])->first();

                    if (!$dependent) {
                        $dependent = Dependent::create([
                            'passport_name' => $dependentData['passport_name'],
                            'date_of_birth' => $dependentData['date_of_birth'],
                            'gender' => $dependentData['gender'],
                            'passport_number' => $dependentData['passport_number'],
                        ]);
                    }

                    // Sync fks in table dependent_trip
                    $dependent->trips()->attach($trip->id);

                    // Collect dependent information for the response
                    $dependents[] = $dependent;
                }
            }

            /* 
             * Generate pdf for car insurance policy
             */
            // Dispatch the job for PDF generation
            GeneratePolicyTravelInsurancePdf::dispatch($trip);

            $responseData = [
                'policy' => $policy,
                'traveler' => $traveler,
                'dependents' => $dependents,
                'premium' => $premium
            ];

            return $this->successResponse($responseData, 'Policy Traveler Insurance Created Successfully', 200);
        } catch (Exception $e) {
            return $this->errorResponse(['massage' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    // store orange-car-insurance
    public function storeOrangeCarInsurance(OrangeCarInsuranceRequest $request)
    {
        try {
            // Get Car Insurance "insurance_number" = 100 
            $insurance = Insurance::where('insurance_number', '100')->first();

            if (!$insurance) {
                return $this->errorResponse(['message' => 'Insurance not found'], 404);
            } else if ($insurance->status != 'active') {
                return $this->errorResponse(['message' => 'Insurance is inactive'], 404);
            }

            // Get Orange_Car_Insurance_type "insurance_number" = 104
            $insuranceType = InsuranceType::where('insurance_type_number', '104')->first();

            if (!$insuranceType) {
                return $this->errorResponse(['message' => 'insurance Type not found'], 404);
            } else if ($insuranceType->status != 'active') {
                return $this->errorResponse(['message' => 'Insurance Type is inactive'], 404);
            }

            // Ensure the user is authenticated
            $user = Auth::user();

            if (!$user) {
                return $this->errorResponse(['message' => 'User not authenticated'], 401);
            }

            // Set type policy "international" becouse create policy_number
            Policy::$type = 'international';

            $premium = PolicyHelper::getPremiumsOrangeInsurance($request);
            if (is_a($premium, 'Illuminate\Http\JsonResponse')) {
                return $premium; // Return the error response from the helper
            }

            // Create Policy record
            $policy = Policy::create([
                'branche_id' => $user->branche_id,
                'insurance_id' => $insurance->id,
                'insurance_type_id' => $insuranceType->id, // This might need a default or valid value
                'user_id' => $user->id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,  // i handle and merge "end_date" to request in function getPremiumsOrangeInsurance
            ]);

            // set fk in pivot table between [ available_car , policies] "available_car_policy"
            $policy->availableCars()->attach($request->available_car_id);

            // set fk in pivot table between [ orange_visited_countries , policies] "orange_visited_country_policy"
            $policy->orangeVisitedCountries()->attach($request->country_visited_id);

            // Create Premiums
            $premium['policy_id'] = $policy->id;
            Premium::create($premium);

            // Create Vehicle record
            $vehicle = Vehicle::create([
                'user_id' => $user->id,
                'policy_id' => $policy->id,
                'engine_number' => $request->car_engine_number,
                'chassis_number' => $request->car_chassis_number,
                'plate_number' => $request->car_plate_number,
                'year_of_manufacturing' => $request->car_year_of_manufacturing,
                'type' => $request->car_type,
                'car_nationality' => $request->car_nationality,
                'purpose_of_license' => 'خاصة',
            ])->setHidden([
                        'user_id',
                        'policy_id'
                    ]);

            // store user_id and insurance_type_id in table insurance_type_user => becouse if know user is vip or no
            $user->insuranceTypes()->attach($insuranceType->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // store user_id and insurance_id in table insurance_user => becouse Relation m - m 
            $user->insurances()->attach($insurance->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            GeneratePolicyOrangeCarInsurancePdf::dispatch($policy);

            $responseData = [
                'policy' => $policy,
                'car' => $vehicle,
                'premium' => $premium,
                'available_car' => AvailableCar::where('id', $request->available_car_id)->value('name'),
                'visited_country' => OrangeVisitedCountry::where('id', $request->country_visited_id)->value('name')
            ];

            return $this->successResponse($responseData, 'Policy Orange Car Insurance Created successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function getDaysByCountry(Country $country)
    {
        try {
            $data = CountryHelper::getDaysByCountry($country->id);
            return $this->successResponse($data, 'Days and Price retrieved successfully');
        } catch (Exception $e) {
            return $this->errorResponse(['massage' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function getMandatoryPolicies()
    {
        try {
            $data = Policy::where('insurance_type_id', 1)->get();
            if (!$data) {
                return $this->errorResponse(['massage' => 'No policies found'], 404);
            }
            return $this->successResponse($data, 'Mandatory Policies retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse(['massage' => $e->getMessage()], 500);
        }
    }

    public function numOfPaidPolicies()
    {
        try {
            $data = Policy::where('status','active')->count();
            return $this->successResponse($data, ' Policies Counted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse(['massage' => $e->getMessage()], 500);
        }
    }
    

}
