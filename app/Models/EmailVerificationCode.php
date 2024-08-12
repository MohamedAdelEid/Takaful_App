<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerificationCode extends Model
{
    use HasFactory;
    protected $table = 'email_verification_code';
    protected $fillable = [
        'email',
        'code',
        'is_verified'
    ];
}
