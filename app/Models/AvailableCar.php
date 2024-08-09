<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableCar extends Model
{
    use HasFactory;
    protected $fillable = ['name','item_id'];
    protected $table = 'available_cars';

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
