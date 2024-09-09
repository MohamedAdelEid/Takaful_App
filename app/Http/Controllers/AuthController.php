<?php

namespace App\Http\Controllers;

use App\Customs\Services\SendResetPasswordService;
use App\Customs\Services\SendVerificationCodeService;
use App\Models\Company\Company;
use App\Models\EmailVerificationCode;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    use ApiResponseTrait;
    public function __construct(private SendResetPasswordService $resetPasswordService,private SendVerificationCodeService $sendVerificationCodeService)
    {
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'nick_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|string|in:user,company',
                'phone' => 'nullable',
                'string',
                'max:15|unique:users,phone',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'nick_name' => $request->nick_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'phone' => $request->phone,
            ]);
            if ($request->role == 'company') {
                Company::create([
                    'user_id' => $user->id
                ]);
            }
            if($user){
            $this->sendVerificationCodeService->send($user);
                $token = JWTAuth::fromUser($user);
                $user['token'] = $token;
                return $this->successResponse($user, 'User Registered Successfully', 201);
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[1] === 1062) {
                return $this->errorResponse(['message' => 'enter valid phone number'], 409);
            }
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        } catch (\Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 422);
            }

            if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
                return $this->errorResponse('Invalid email or Password', 401);
            }
            $user = auth()->user();
            if ($user->role == 'company') {
                $user['data'] = $user->company;
            }
            unset($user['data']);
            return $this->successResponse([
                'user' => $user,
                'token' => $token,
            ], 'User logged in successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return $this->successResponse(null, 'User successfully logged out', 200);
        } catch (\Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        }
    }
    public function changePassword(Request $request)
    {
        try {
            $user = Auth::user();
            $validated = Validator::make($request->all(), [
                'current_password' => 'required|string|min:6',
                'new_password' => 'required|string|min:6|confirmed'
            ]);
            if ($validated->fails()) {
                return $this->errorResponse($validated->errors(), 422);
            }
            $validatedData = $validated->validated();
            if (!Hash::check($validatedData['current_password'], $user->password)) {
                return $this->errorResponse('This password does not match Current password', 400);
            }
            $user->password = Hash::make($validatedData['new_password']);
            $user->save();
            return $this->successResponse(null, 'Password changed successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        }
    }
    public function profile()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return $this->errorResponse('No Authenticated User', 401);
            }

            if ($user->role == 'company') {
                $company = $user->company;
                $user = [
                    'user' => $user->makeHidden('role'),
                    'company' => $company
                ];
            } elseif ($user->role == 'user') {
                $user = $user->makeHidden('role');
            }

            return $this->successResponse(['user' => $user], 'User retrieved Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        }
    }
    public function deleteUser(Request $request){
        try {
            $user = User::find(Auth::id());
            if (!$user){
                return $this->errorResponse('user not found', 404);
            }
            $user->delete();
            return $this->successResponse(null, 'User deleted successfully ');
        }catch (\Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], 500);
        }
    }

    public function sendResetPassword(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'exists:users,email']
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 422);
            }
            $user = User::where('email',$request->email)->first();
            if($user){
                $this->resetPasswordService->sendResetPasswordLink($user->email);
                return $this->successResponse(null,'Reset password link sent successfully');
            }
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return $this->errorResponse('User Not Found',404);
        }
         catch(\Exception $e){
            return $this->errorResponse(['message' => $e->getMessage()],500);
        }
    }
    public function resetPassword(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'exists:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 422);
            }
            $user = User::where('email', $request->email)->first();
                $user->password = bcrypt($request->password);
                $user->save();
                return $this->successResponse(null, 'Password reset successfully');
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|integer'
        ]);

        $verificationRecord = EmailVerificationCode::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$verificationRecord) {
            return response()->json(['message' => 'Invalid verification code or email.'], 400);
        }

        $verificationRecord->update(['is_verified' => true]);

        User::where('email', $request->email)->update(['email_verified_at' => now()]);

        return response()->json(['message' => 'Email verified successfully.']);
    }
}
