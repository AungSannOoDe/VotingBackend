<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSEController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\AblumController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TempoController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotesController;
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
        Route::apiResource('ablums', AblumController::class);
         Route::controller(profileController::class)->prefix("user-profile")->group(function () {
            Route::post('/logout', 'logout');
            Route::get('/profile', 'profile');
            Route::post('/change-password', 'changePassword');
            Route::patch('/change-name', 'changeName');
            Route::post('/change-profile-image', 'changeProfileImage');
        });

        Route::get('/dashboard-stream', [SSEController::class, 'stream']);
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
        Route::patch('/change-male','changeMale');
    });
    Route::prefix('voter/chat')->group(function () {
    Route::get('conversations', [ChatController::class, 'voterConversations']);
    Route::get('conversations/{conversation}', [ChatController::class, 'voterConversation']);
        Route::post('conversations/{conversation}/messages', [ChatController::class, 'voterSendMessage']);
    });

    Route::apiResource('temp',TempoController::class);
});
});
Route::prefix('timer')->group(function () {
    Route::get('/', [TimeController::class, 'getTime']);
    Route::post('/set', [TimeController::class, 'setTime']);
    Route::post('/reset', [TimeController::class, 'resetTime']);
});
 Route::apiResource('/votes',VotesController::class);
Route::apiResource('events', EventController::class);
Route::controller(ElectorGetController::class)->group(function () {
    Route::get('get-elector','getElector');
    Route::get('get-history','getElectorHistory');
    Route::get('get-details/{id}','getDetails');
});

