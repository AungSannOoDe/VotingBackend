<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TempoController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\ElectorController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\VoterProfileController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get("/",function(){
    return "api";
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/token-login', 'tokenLogin');
    Route::post('/register', 'register');
    Route::post('/voter-reg','voterRegister');
    Route::post('/voter-login','voterLogin');
});
Route::middleware('auth:sanctum')->group(function () {
     Route::controller(profileController::class)->prefix("user-profile")->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/profile', 'profile');
        Route::post('/change-password', 'changePassword');
        Route::patch('/change-name', 'changeName');
        Route::post('/change-profile-image', 'changeProfileImage');
    });
    Route::apiResource('electors',ElectorController::class);
    Route::apiResource('voters', VoterController::class);
    Route::apiResource('tokens', TokenController::class);
});
Route::middleware('voter.auth')->group(function () {
    Route::apiResource('electors',ElectorController::class)->except(['store']);
    Route::controller(VoterProfileController::class)->prefix("voter")->group(function () {
        Route::post('/voter-logout', 'voterLogout');
    });
    Route::apiResource('temp',TempoController::class);
});
Route::apiResource('events', EventController::class);
