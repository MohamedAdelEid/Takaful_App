<?php

namespace App\Customs\Services;

use App\Models\EmailVerificationCode;
use App\Notifications\SendCodeVerification;
use Illuminate\Support\Facades\Notification;

class SendVerificationCodeService
{
    public function send(object $user){
        Notification::send($user,new SendCodeVerification($this->generateCode($user->email)));
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
