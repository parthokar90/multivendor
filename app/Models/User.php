<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\admin\Country;
use App\Models\admin\District;
use App\Models\admin\PostCode;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    //this function show customer country name 
    public function country(){
      return $this->belongsTo(Country::class,'country_id');
    }

    //this function show customer post code 
    public function postCode(){
        return $this->belongsTo(PostCode::class,'zip_code');
    }

    //this function show customer post code 
    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }

}
