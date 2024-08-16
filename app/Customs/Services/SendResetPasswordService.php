<?php 

namespace App\Customs\Services;
use Illuminate\Support\Str;
use App\Models\EmailVerificationCode;
use App\Models\EmailVerificationToken;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendResetPasswordNotification;

class SendResetPasswordService 
{
    public function sendResetPasswordLink($email){
        Notification::route('mail', $email)->notify(new SendResetPasswordNotification($this->generateCode($email)));
    }
    public function generateCode($email){
        $checkIfCodeExists = EmailVerificationCode::where('email',$email)->first();
        if($checkIfCodeExists) $checkIfCodeExists->delete();

        $code = rand(10000, 99999);

        EmailVerificationCode::create([
            'email' => $email,
            'code' => $code,
            'is_verified' => false,
        ]);

        return $code;
    }
}