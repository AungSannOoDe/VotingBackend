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
use App\Http\Controllers\ElectorGetController;
use App\Http\Controllers\VoterProfileController;
use App\Http\Controllers\StudentProfileController;

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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['user.auth'])->group(function () {
         Route::controller(profileController::class)->prefix("user-profile")->group(function () {
            Route::post('/logout', 'logout');
            Route::get('/profile', 'profile');
            Route::post('/change-password', 'changePassword');
            Route::patch('/change-name', 'changeName');
            Route::post('/change-profile-image', 'changeProfileImage');
        });
        Route::prefix('user/chat')->group(function () {
            Route::get('conversations', [ChatController::class, 'userConversations']);
            Route::get('conversations/{conversation}', [ChatController::class, 'userConversation']);
            Route::post('conversations/{conversation}/messages', [ChatController::class, 'userSendMessage']);
        });
        Route::apiResource('electors',ElectorController::class);
        Route::apiResource('voters', VoterController::class);
        Route::apiResource('tokens', TokenController::class);
    });
});
Route::middleware(['auth:sanctum'])->group(function () {
Route::middleware('voter.auth')->group(function () {
    Route::controller(VoterProfileController::class)->prefix("voter")->group(function () {
        Route::post('/voter-logout', 'voterLogout');
    });
     Route::controller(StudentProfileController::class)->prefix("voter-profile")->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/profile', 'profile');
        Route::post('/change-password', 'changePassword');
        Route::patch('/change-name', 'changeName');
        Route::post('/change-profile-image', 'changeProfileImage');
    });
    Route::prefix('voter/chat')->group(function () {
        Route::get('conversations', [ChatController::class, 'voterConversations']);
        Route::get('conversations/{conversation}', [ChatController::class, 'voterConversation']);
        Route::post('conversations/{conversation}/messages', [ChatController::class, 'voterSendMessage']);
    });
    Route::controller(ElectorGetController::class)->group(function () {
        Route::get('get-elector','getElector');
        Route::get('get-details/{id}','getDetails');
    });
    Route::apiResource('temp',TempoController::class);
});
});
Route::apiResource('events', EventController::class);
