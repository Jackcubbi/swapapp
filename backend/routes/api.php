<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\TradeController;

// CORS test route
Route::get('/test', function () {
  return response()->json(['message' => 'CORS is working!']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });

  Route::post('/logout', [AuthController::class, 'logout']);

  // Items
  Route::apiResource('items', ItemController::class);
  Route::get('/my-items', [ItemController::class, 'myItems']);

  // Trades
  Route::apiResource('trades', TradeController::class)->only(['index', 'store']);
});
