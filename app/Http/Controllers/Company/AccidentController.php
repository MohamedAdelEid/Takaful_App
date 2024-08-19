<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\AccidentRequest;
use App\Models\Company\Accident;
use App\Models\Company\Policy;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;

class AccidentController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $accidents = Accident::with('policy', 'user:id,name')->get();

            return $this->successResponse($accidents, 'Accidents retrieved successfully');
        } catch (Exception $e) {
            return $this->errorResponse(['massage' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccidentRequest $request)
    {
        try {

            // get user will make accident
            $user = User::where('email', $request->email_user)->first();

            // get policy will make accident
            $policy = Policy::where('policy_number', $request->policy_number)->first();

            $accident = Accident::create([
                'user_id' => $user->id,
                'policy_id' => $policy->id,
                'date' => $request->date,
                'location' => $request->location,
                'description' => $request->description
            ]);

            return $this->successResponse($accident, ['Report Accident Create successfully!'], 200);

        } catch (Exception $e) {
            return $this->errorResponse(['massage' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }


}
