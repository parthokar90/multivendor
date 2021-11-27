<?php
  
namespace App\Http\Controllers\admin;
   
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\SliderValidate;
use App\Http\Requests\admin\SliderUpdateValidate;
use App\Models\admin\Slider;
use DataTables;
  
class SliderController extends Controller
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
        $list = Slider::orderBy('id','DESC')->get();
        if ($request->ajax()) {
            return Datatables::of($list)
                ->addIndexColumn()

                 //for image
                 ->addColumn('image', function($row){
                    $src=asset('admin/slider/'.$row->image);
                    return '<img src="'.$src.'" border="0" width="80" class="img-rounded" align="center" />';
                  })

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
                     $btn = '<a class="btn btn-primary btn-sm" title="Edit Slider" href="'.route('sliders.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                     return $btn;
                   })

                   ->rawColumns(['image','status','action'])

                   ->make(true);
              }
            return view('admin.slider.index');
     }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderValidate $request)
    {
          //check if file is upload
          $image_name='';
          if($request->hasFile('image')){
            $image_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(('admin/slider/'), $image_name);
          } 
  
          $store = new Slider;  

          $store->image=$image_name;

          $store->text=$request->text;

          $store->description=$request->description;

          $store->link=$request->link;

          $store->created_by=auth()->user()->id;

          $store->status=$request->status;  

          $store->save();

          return redirect()->route('sliders.index')
          ->with('success','Slider created successfully.');
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateValidate $request,Slider $slider)
    {
         //check if file is upload
         if($request->hasFile('image')){
            $image_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(('admin/slider/'), $image_name);
          }else{
            $image_name = $slider->image;
          }

          $slider->image=$image_name;

          $slider->text=$request->text;

          $slider->description=$request->description;

          $slider->link=$request->link;

          $slider->created_by=auth()->user()->id;

          $slider->status=$request->status;  

          $slider->save();

          return redirect()->route('sliders.index')
          ->with('success','Slider update successfully.');    
    }
}