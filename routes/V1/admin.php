<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\PasswordResetController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;

// Admin
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\UserController;

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\VendorController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\SubCategoryController;
use App\Http\Controllers\Api\V1\BrandController;


    //Registration
    Route::prefix('admin/auth')->group(function () {

        
        //Registration
        Route::get('/social-login', [LoginController::class,'social_login']);  
        Route::post('/register', [RegisterController::class, 'register']);
        Route::post('/login', [LoginController::class, 'login']);
        Route::get('/resend/email-verification/{email}', [LoginController::class, 'resend_email_verification']);
        Route::get('/verify-email/{email}/token/{token}', [LoginController::class, 'verify_email']);

        //Password Reset
        Route::get('/password-reset-request/{email}', [PasswordResetController::class, 'password_reset_request']);
        Route::get('/password-reset-verify/{code}', [PasswordResetController::class, 'password_reset_verify']);
        Route::post('/password-reset/{id}', [PasswordResetController::class, 'password_reset']);
        

    });



    // Admin Panel
    Route::prefix('admin')->middleware('auth:sanctum')->group(function () {

        
        //Profile
        Route::get('/profile', [ProfileController::class,'profile'])->name('profile');
        Route::get('/logout', [ProfileController::class,'logout'])->name('logout');

        //Customers Management  
        Route::get('/customers/list', [CustomerController::class, 'list']);
        Route::apiResource('customers', CustomerController::class);

        //Vendors Management  
        Route::get('/vendors/list', [VendorController::class, 'list']);
        Route::apiResource('vendors', VendorController::class);
        
        //Products Management  
        Route::get('/products/list', [ProductController::class, 'list']);
        Route::apiResource('products',ProductController::class);
      
        //Categories Management  
        Route::get('/categories/list', [CategoryController::class, 'list']);
        Route::apiResource('categories', CategoryController::class);

        //SubCategories Management  
        Route::get('/subcategories/list', [SubCategoryController::class, 'list']);
        Route::apiResource('subcategories', SubCategoryController::class);

        //Brands Management  
        Route::get('/brands/list', [BrandController::class, 'list']);
        Route::apiResource('brands', BrandController::class);
        
        //Orders
        Route::get('/orders',[OrderController::class, 'index'])->name('orders.index');



    });


    Route::fallback(function() {
        return response()->json([
            "message" => 'Invaled Route',
         ],404);
    });