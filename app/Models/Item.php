<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'items';

    protected $hidden = ['created_at','updated_at'];

    public function availableCars(){
        return $this->hasMany(AvailableCar::class);
    }
}
