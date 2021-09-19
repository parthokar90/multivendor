<?php

namespace App\Models\vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\District;

class DeliveryCharge extends Model
{
    use HasFactory;

    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
}
