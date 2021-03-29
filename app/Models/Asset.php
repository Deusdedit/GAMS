<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;
use App\Models\Receiving;
use Spatie\Activitylog\Traits\LogsActivity;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = [

        'name', 'purchased_date','condition', 'serial_number','product_number','location', 'activity'

    ];

    public function receivings()
    {
        return $this->belongsTo(Receiving::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function disposals()
    {
        return $this->hasOne(Disposal::class);
    }

    public function vehicles()
    {
        return $this->hasOne(Vehicle::class);
    }

    public function generators()
    {
        return $this->hasOne(Generator::class);
    }
}
