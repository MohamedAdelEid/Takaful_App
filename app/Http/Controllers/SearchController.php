<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Company\Policy;
use App\Models\Company\Vehicle;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    Use ApiResponseTrait;


    public function search(Request $request)
    {
        try {
            $query = Policy::query();
    
            if ($request->has(['from', 'to'])) {
                $query->whereBetween('start_date', [$request->from, $request->to]);
            }
    
            if ($request->has('user_name') || $request->has('passport_number')) {
                $userQuery = User::where('role', 'user');
    
                if ($request->has('user_name')) {
                    $userQuery->where(function ($q) use ($request) {
                        $q->where('first_name', 'like', '%' . $request->user_name . '%')
                            ->orWhere('last_name', 'like', '%' . $request->user_name . '%')
                            ->orWhere('nick_name', 'like', '%' . $request->user_name . '%');
                    });
                }
    
                if ($request->has('passport_number')) {
                    $userQuery->where('passport_number', $request->passport_number);
                }
    
                $userIds = $userQuery->pluck('id');
                $query->whereIn('user_id', $userIds);
            }
    
            if ($request->has('plate_number') || $request->has('chassis_number')) {
                $vehicleQuery = Vehicle::query();
    
                if ($request->has('plate_number')) {
                    $vehicleQuery->where('plate_number', $request->plate_number);
                }
    
                if ($request->has('chassis_number')) {
                    $vehicleQuery->where('chassis_number', $request->chassis_number);
                }
    
                $vehiclePolicyIds = $vehicleQuery->pluck('policy_id');
                $query->whereIn('id', $vehiclePolicyIds);
            }
    
            $policies = $query->with(['user', 'vehicle'])->get();
    
            return $this->successResponse($policies, 200);
            
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }
    
}
