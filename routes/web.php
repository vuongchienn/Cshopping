<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\customer\ProductController as CustomerProductController;
use App\Http\Controllers\customer\HomeController as HomeController;
use App\Http\Controllers\customer\CartController as CartController;
use App\Http\Controllers\customer\CheckoutController as CheckoutController;
use App\Http\Controllers\customer\OrderController as OrderController;
use App\Http\Controllers\auth\AuthController as AuthController;
use App\Http\Controllers\customer\CommentController as CommentController;
use App\Http\Controllers\customer\ImageController as ImageController;
use App\Http\Controllers\admin\CategoryController as CategoryController;
use App\Http\Controllers\admin\BrandController as BrandController;
use App\Http\Controllers\admin\UserController ;
use App\Http\Controllers\admin\ProductImageController as ProductImageController;
use App\Http\Controllers\admin\ProductDetailController as ProductDetailController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;


use App\Http\Controllers\admin\ProductController as AdminProductController;


use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Middleware\CheckAminLogin;
use App\Http\Middleware\CheckMemberLogin;
use App\Http\Middleware\CheckRoleAdmin;
use App\Http\Middleware\CheckRoleCustomer;

Route::get('/', [HomeController::class,'index'])->name('home');







Route::prefix('customer')->middleware([CheckMemberLogin::class,CheckRoleCustomer::class])->group(function () {
 
    Route::resource('cart',CartController::class);  
    Route::resource('check-out', CheckoutController::class);
    Route::resource('order',OrderController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('avatar', ImageController::class);

});

Route::prefix('admin')->middleware([CheckMemberLogin::class,CheckRoleAdmin::class])->group(function () {
    Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('product/{product_id}/image', ProductImageController::class);
    Route::resource('product/{product_id}/detail', ProductDetailController::class);
    Route::resource('orders', AdminOrderController::class);

    Route::post('categorySeach',[CategoryController::class,'search'])->name('searchCategory');
    Route::post('userSeach',[UserController::class,'search'])->name('searchUser');
    Route::post('brandSeach',[BrandController::class,'search'])->name('searchBrand');
    Route::post('productSeach',[AdminProductController::class,'search'])->name('searchProduct');
    Route::post('orderSeach',[AdminOrderController::class,'search'])->name('searchOrder');
});



Route::prefix('customer')->group(function () {
    Route::resource('products',CustomerProductController::class);
    Route::resource('home', HomeController::class);
    Route::get('category/{categoryName}',[CustomerProductController::class,'category']);
    Route::get('tag/{tagName}',[CustomerProductController::class,'tag']);
});

Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('checkLogin',[AuthController::class,'checkLogin'])->name('checkLogin');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::get('/checkout/vnPayCheck',[CheckoutController::class,'vnPayCheck']);
Route::get('register',[AuthController::class,'registerView'])->name('registerView');
Route::post('register',[AuthController::class,'register'])->name('register');



