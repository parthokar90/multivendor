<?php

namespace App\Services\Front;

use App\Repository\front\HomepageRepository;

class HomePageService{

    protected $homePageRepository;

    public function __construct(HomepageRepository $homePageRepository)
    {
        $this->HomepageRepository = $homePageRepository;
    }

    //home page index repository service
    public function index(){
        return $this->HomepageRepository->index();
    }

    //home page shop single repository service
    public function shopSingle($id){
        return $this->HomepageRepository->shopSingle($id);
    }

    //home page product single repository service
    public function productSingle($id){
        return $this->HomepageRepository->productSingle($id);
    }

    //home page brand product repository service
    public function brandProduct($id){
        return $this->HomepageRepository->brandProduct($id);
    }

    //home page product search repository service 
    public function search($request){
        return $this->HomepageRepository->search($request);
    }

    //product review repository service
    public function productReview($request,$productid){
        return $this->HomepageRepository->productReview($request,$productid);
    }

    //cart coupon repository service
    public function cartCoupon($request){
        return $this->HomepageRepository->cartCoupon($request);
    }

    //all active brand repository service
    public function allBrand(){
        return $this->HomepageRepository->allBrand();
    }
    
    //category product repository service
    public function categoryProduct($id){
        return $this->HomepageRepository->categoryProduct($id);
    }

    //all active shop repository service
    public function allShop(){
        return $this->HomepageRepository->allShop();
    }

    //all active category repository service
    public function allCategory(){
        return $this->HomepageRepository->allCategory();
    }

     //all blog  method repository service
     public function blog(){
        return $this->HomepageRepository->blog();
      }

    //blog single method repository service
    public function blogSingle($id){
      return $this->HomepageRepository->blogSingle($id);
    }

    //cart index method repository service
    public function cartIndex(){
        return $this->HomepageRepository->cartIndex();
    }

    //cart add method repository service
    public function cart($request){
        return $this->HomepageRepository->cart($request);
    }

     //checkout  method repository service
     public function checkout(){
        return $this->HomepageRepository->checkout();
    }

    //cart delete method repository service
    public function cartDelete($id){
        return $this->HomepageRepository->cartDelete($id);
    }

    //place order method repository service
    public function orderPlaced($request){
        return $this->HomepageRepository->orderPlaced($request);
    }
}
