<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $fillable = [

        'previous_odometer', 'current_odometer','issued', 'requested','activity','date','attachments' 

    ];
 
    public function generators()
    {
        return $this->belongsTo(Generator::class);
    }

    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
