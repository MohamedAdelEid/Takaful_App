<?php 

namespace App\Customs\Services;
use App\Models\EmailVerificationToken;
use App\Notifications\SendResetPasswordNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class SendResetPasswordService 
{
    public function sendResetPasswordLink($email){
        Notification::route('mail', $email)->notify(new SendResetPasswordNotification($this->generateResetPasswordLink($email)));
    }
    public function generateResetPasswordLink($email){
        $checkIfTokenIfExists =   EmailVerificationToken::where('email', $email)->first();
        if ($checkIfTokenIfExists) $checkIfTokenIfExists->delete();
        $token = Str::uuid();
     $url = config('app.url') . "/reset-password?token=" . $token . "&email=" . urlencode($email);
     $saveToken = EmailVerificationToken::create([
        'email' => $email,
        'token' => $token,
        'expired_at' => now()->addHour()
    ]);
    if($saveToken){
        return $url;
    }
    return '';
    }
}