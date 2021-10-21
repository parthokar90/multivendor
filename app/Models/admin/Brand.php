<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor\Product;

class Brand extends Model
{
    use HasFactory;

    //this function show all brand product count
    public function countProduct($id){
        return Product::where('brand_id',$id)->count();
    }
}
