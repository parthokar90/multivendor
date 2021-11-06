<?php 

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\vendor\DashboardController;
use App\Http\Controllers\vendor\OrderController;
use App\Http\Controllers\vendor\ProductController;
use App\Http\Controllers\vendor\ProductReviewController;
use App\Http\Controllers\vendor\DeliveryChargeController;
use App\Http\Controllers\vendor\CouponController;
use App\Http\Controllers\vendor\ReportController;


//registration route start
  Route::get('vendor/registration', [AccountController::class, 'vendorRegister'])->name('vendor.registration');
  Route::post('vendor/registration', [AccountController::class,'vendorRegisterProcess'])->name('vendor.registration.process');
//registration route end


//login route start
  Route::get('/login/vendor',[LoginController::class,'showVendorLoginForm'])->name('vendor.login');
  Route::post('/login/vendor',[LoginController::class,'vendorLogin'])->name('vendor.login.process');
//login route end


//dashboard route start
  Route::get('vendor/dashboard',[DashboardController::class,'index'])->name('vendor.dashboard');
  Route::get('profile',[DashboardController::class,'vendorProfile'])->name('vendor.profile');
  Route::post('update/profile/{id}',[DashboardController::class,'updateVendorProfile'])->name('vendor.profile.update');
//dashboard route end


//product route start
  Route::resource('products',ProductController::class);
  Route::get('att/value/{id}',[ProductController::class,'attributeValue'])->name('att.values');
  Route::get('product/stock',[ProductController::class,'productStock'])->name('product.stock');
  Route::get('product/wishlist/',[ProductController::class,'productWishlist'])->name('product.wishlist');
  Route::post('temp/product/attribute',[ProductController::class,'tempAttribute'])->name('product.temp.attribute');
  Route::get('list/attribute/',[ProductController::class,'getTempAttribute'])->name('list.attribute');
  Route::get('delete/attribute/{id}',[ProductController::class,'deleteAttribute']);
  Route::get('delete/attribute/product/{id}',[ProductController::class,'deleteAttributePro']);
  Route::get('edit/attribute/product/{id}',[ProductController::class,'editAttributePro']);
  Route::post('update/attribute/product/',[ProductController::class,'updateAttributePro'])->name('up_att_pro');
//product route end


//product review route start
  Route::resource('reviews',ProductReviewController::class);
//product review route end

//order route start
  Route::resource('orders',OrderController::class);
  Route::post('orders-status-update/{orderid}',[OrderController::class,'statusUpdate'])->name('order_status_update');
//order route end

//delivery charge route start
  Route::resource('delivery-charge',DeliveryChargeController::class);
//delivery charge route end

//coupon route start
  Route::resource('coupon',CouponController::class);
//coupon route end

//coupon route start
  Route::get('order-report',[ReportController::class,'index'])->name('vendor.order.report');
  Route::post('order-report-show',[ReportController::class,'showReport'])->name('vendor.order.report.generate');
//coupon route end
