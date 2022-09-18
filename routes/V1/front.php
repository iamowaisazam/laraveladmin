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



    //Registration
    Route::prefix('front')->group(function () {
        
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






    Route::fallback(function() {
        return response()->json([
            "message" => 'Invaled Route',
         ],404);
    });