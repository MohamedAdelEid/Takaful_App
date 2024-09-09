<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InsuranceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $insuranceType;
    public $recipientName;
    public $emailMessage; // Renamed message to emailMessage

    public function __construct($insuranceType, $recipientName)
    {
        $this->insuranceType = $insuranceType;
        $this->recipientName = $recipientName;
    }

    public function build()
    {
        $subject = 'شكرا لتواصلك مع أمّن شركتك';

        $this->emailMessage = $this->insuranceType == 'medical'
            ? "مساء الخير \n شكرا لتواصلك مع أمّن شركتك \n نرجو من حضرتك ارسال شيت : \n- تواريخ الميلاد (يوم،شهر، سنة) \n- فئات الموظفين ( بشرط ان تكون كل فئة ليست اقل من ٢١ موظف)\nسيتم عمل عرض للتامين طبى و ارساله فى أقرب وقت 😊😊"
            : "مساء الخير \n شكرا لتواصلك مع أمّن شركتك \n سيقوم احد المختصصين بالتواصل فى أقرب وقت 😊😊";

        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($subject)
            ->view('emails.insurance-email')
            ->with([
                'emailMessage' => $this->emailMessage, // Use renamed variable
                'recipientName' => $this->recipientName
            ]);
    }
}

