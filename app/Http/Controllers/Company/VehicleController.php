<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Models\Company\Vehicle;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    use ApiResponseTrait;
    public function geAllVehiclesModel(){
        try{
            $vehicles = Vehicle::select('model')->get();
            if(!$vehicles){
                return $this->errorResponse('No vehicles found', 404);
            }
            return $this->successResponse($vehicles, 'Vehicles retrieved successfully');
        }catch(\Exception $e){
            return $this->errorResponse(['message' => $e->getMessage()],500 );
        }
    }
    public function geAllVehiclesColor(){
        try{
            $vehiclesColor = Vehicle::select('color')->get();
            if(!$vehiclesColor){
                return $this->errorResponse('No vehicles found', 404);
            }
            return $this->successResponse($vehiclesColor, 'Vehicles color retrieved successfully');
        }catch(\Exception $e){
            return $this->errorResponse(['message' => $e->getMessage()],500 );
        }
    }
}
