<?php

namespace App\Http\Controllers\front;
use App\Services\Front\HomePageService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FrontController extends Controller
{
    protected $homeService;

    public function __construct(HomePageService $homeService){
          $this->HomePageService = $homeService;
    }

    //home page method
    public function index(){
      return $this->HomePageService->index();
    }

    //contact method view
    public function contact(){
      return view('front.page.contact');
    } 

    //shop single method
    public function shopSingle($id){
      return $this->HomePageService->shopSingle($id);
    }

    //product single method
    public function productSingle($id){
      return $this->HomePageService->productSingle($id);
    }

    //product review
    public function productReview(Request $request,$productid){
      return $this->HomePageService->productReview($request,$productid);
    }

    //product search
    public function search(Request $request){
      return $this->HomePageService->search($request);
    }

    //category product method
    public function categoryProduct($id){
      return $this->HomePageService->categoryProduct($id);
    }

    //all active category
    public function allCategory(){
      return $this->HomePageService->allCategory();
    }

    //all active shop
    public function allShop(){
      return $this->HomePageService->allShop();
    }

    //all active brand
     public function allBrand(){
      return $this->HomePageService->allBrand();
     }

    //brand product method
    public function brandProduct($id){
      return $this->HomePageService->brandProduct($id);
    }

    //blog single method
    public function blogSingle($id){
      return $this->HomePageService->blogSingle($id);
    }

}
