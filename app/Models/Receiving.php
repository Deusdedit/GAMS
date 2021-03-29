<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;
use App\Models\Receiving;

class Receiving extends Model
{
    use HasFactory;

    // protected $fillable = [

    //     'ledger_number', 'quantity','cost', 'item','supplier','condition','total_cost', 'date'

    // ];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
