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
        //
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
