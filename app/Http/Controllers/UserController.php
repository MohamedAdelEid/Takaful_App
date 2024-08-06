<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;
    public function getUsers(Request $request)
    {
        try {
            $users = User::where('role','user')->get();
            if($users->isEmpty()){
                return $this->errorResponse('no users founded', 404);
            }
            return $this->successResponse($users,'users retrieved Successfully');
        }catch (\Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        }
    }
    public function userActivation(User $user){
        try {

            $user->update(['status' => 'active']);
            return $this->successResponse($user,'user activated successfully');
        }catch (\Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        }
    }
    public function disableUser(User $user){
        try {
            $user->update(['status' => 'inactive']);
            return $this->successResponse($user,'user disabled successfully');
        }catch (\Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        }
    }
}
