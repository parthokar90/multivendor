<?php 

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\customer\DashboardController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\WishlistController;
use App\Http\Controllers\customer\ProfileController;
use App\Http\Controllers\customer\OrderController;
use App\Http\Controllers\customer\CheckoutController;


//login route start
  Route::get('/customer/login', [LoginController::class, 'showCustomerLoginForm'])->name('customer.login');
  Route::post('/customer/login', [LoginController::class,'customerLogin'])->name('customer.login.process');
//login route end

//registration route start
  Route::get('/customer/registration', [AccountController::class, 'customerRegister'])->name('customer.registration');
  Route::post('/customer/registration', [AccountController::class,'customerRegisterProcess'])->name('customer.registration.process');
//registration route end

//dashboard route start
  Route::get('customer/dashboard', [DashboardController::class,'index'])->name('customer.dashboard');
//dashboard route end

//cart route start
  Route::resource('cart',CartController::class);
  Route::get('cart/item/delete/{id}',[CartController::class,'delete'])->name('item.delete');
//cart route end


//checkout route start
  Route::get('checkout',[CheckoutController::class,'index'])->name('customer.checkout');
//checkout route end

//wishlist route start
  Route::resource('wishlist',WishlistController::class);
  Route::get('add/wishlist/{id}',[WishlistController::class,'addWishlist'])->name('add.wishlist');
//wishlist route end

//profile route start
  Route::get('customer-profile',[ProfileController::class,'profile'])->name('customer.profile');
  Route::post('customer-profile-update/{id}',[ProfileController::class,'profileUpdate'])->name('customer.profile.update');
//profile route end

//Order route start
  Route::get('customer-order',[OrderController::class,'order'])->name('customer.order');
  Route::get('customer-order-edit/{id}',[OrderController::class,'orderDetails'])->name('customer.order.edit');
  Route::post('customer-order-update/{id}',[OrderController::class,'orderUpdate'])->name('customer.order.update');
//Order route end


