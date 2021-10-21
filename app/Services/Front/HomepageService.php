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

    //blog single method repository service
    public function blogSingle($id){
      return $this->HomepageRepository->blogSingle($id);
    }
}
