<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'logout'])->name('logout');
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    Route::prefix('place')->group(function () {
        Route::get('/', [PlaceController::class, 'index']);
        Route::post('/', [PlaceController::class, 'create']);
        Route::delete('/{id}', [PlaceController::class, 'delete']);
        Route::get('/{id}', [PlaceController::class, 'show']);
        Route::put('/{id}', [PlaceController::class, 'update']);
    });
    Route::middleware('admin')->group(function () {
        Route::get('/admin', function (Request $request) {
            return response()->json(['message' => 'Halaman admin']);
        });
    });
});
