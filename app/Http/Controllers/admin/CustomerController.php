<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use DB;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = DB::table('users')->orderBy('id','DESC')->get();
        if ($request->ajax()) {
            return Datatables::of($list)
                ->addIndexColumn()

                  // for status  
                  ->addColumn('status', function($row){
                    if($row->status==1){
                       $status='Active';
                     }else{
                        $status='Inactive';
                     }    
                      return $status;
                    })

                  //for action column
                  ->addColumn('action', function($row){
                     $btn = '<a class="btn btn-primary btn-sm" title="Edit Customer" href="'.route('customers.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                     return $btn;
                   })

                   ->rawColumns(['status','action'])

                   ->make(true);
              }
            return view('admin.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user=User::findOrFail($id);
       return view('admin.customer.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
      $user=User::findOrFail($id);
      $user->first_name=$request->first_name;  
      $user->last_name=$request->last_name;  
      $user->status=$request->status;   
      $user->save();

      return redirect()->route('customers.index')
      
      ->with('success','Customer has update successfully.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
