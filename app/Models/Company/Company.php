<?php

namespace App\Models\Company;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    public $timestamps = false;

    protected $fillable = ['user_id','city','street','objective'];
    /**
     * Define Relation between company - users [ one - many ]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
