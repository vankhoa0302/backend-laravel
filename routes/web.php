<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController
};
use App\Http\Controllers\Admin\{
    CategoryController,
    SubcategoryController,
    AttributeController,
    ProductController,
    SliderController,
    BlogController,
    OrderController,
    DashboardController
};
use App\Http\Controllers\User\{
    OrderController as UserOrderController,
    ProfileController
};
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//===================Admin route list========================
Route::group(['middleware' => ['auth', 'check_role'], 'prefix' => 'admin' ], function () {
    Route::name('admin.')->group(function () {

        // Dashboard route
        Route::get('dashboard',[DashboardController::class, 'index'])
            ->name('dashboard.index');

        // Category route
        Route::get('categories/list',[CategoryController::class, 'getCategories'])
            ->name('categories.list');
        Route::apiResource('categories', CategoryController::class);

        // Subcategory route
        Route::apiResource('subcategories', SubcategoryController::class);

        // Attribute route
        Route::apiResource('attributes', AttributeController::class);
        
        // Product route
        Route::get('products/list',[ProductController::class, 'getProducts'])
            ->name('products.list');

        Route::resource('products', ProductController::class);

        // Slider route
        Route::apiResource('sliders', SliderController::class);
        
        // Blog route
        Route::resource('blogs', BlogController::class)->except('show');

        // Order route
        Route::resource('orders', OrderController::class)->only(['index','show','update']);

    });
    
});


//==============Register and login/logout route list================
Route::get('register',[RegisterController::class, 'index'])->name('register.index');

Route::post('register',[RegisterController::class, 'store'])->name('register.store');

Route::get('login',[LoginController::class, 'index'])->name('login.index');

Route::post('login',[LoginController::class, 'authenticate'])->name('login.auth');

Route::get('logout',[LoginController::class, 'logout'])->name('logout');



//==================Shop route list=====================
Route::name('front.')->group(function () {
    // Home route
    Route::get('/',[HomeController::class, 'index'])->name('home.index');
});