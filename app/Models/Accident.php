<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Vehicle;

class Accident extends Model
{
    use HasFactory;
    
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
