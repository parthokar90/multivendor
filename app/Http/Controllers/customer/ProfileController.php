<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    //this function show customer profile data
    public function profile(){
      $profile = User::findOrFail(auth()->user()->id);
      return view('customer.profile',compact('profile'));
    }

    //this function is for customer profile update
    public function profileUpdate(Request $request,$id){

        $profile = User::findOrFail($id);
         //check if file is upload
       $image_name=$profile->image;
       if($request->hasFile('image')){
           $image_name = time().'.'.$request->image->getClientOriginalExtension();
           $request->image->move(('customer/profile/'),$image_name);
       }
        $profile->first_name=$request->first_name;
        $profile->last_name=$request->last_name;
        $profile->image=  $image_name;
        $profile->address=$request->address;
        $profile->save();
        return redirect()->back()->with('success','Profile update successfully.');
    }
}
