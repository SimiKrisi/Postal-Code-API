<?php

use App\Http\Controllers\CountiesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettlementsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/users/login', [UserController::class,'login']);
Route::get('/settlements', [SettlementsController::class,'index'])/*->middleware('auth:sanctum')*/;
Route::get('/counties', [CountiesController::class,'index'])/*->middleware('auth:sanctum')*/;
Route::post('/settlements', [SettlementsController::class,'store'])->middleware('auth:sanctum');
Route::post('/counties', [CountiesController::class,'store'])->middleware('auth:sanctum');
Route::patch('/settlements/{id}', [SettlementsController::class,'update'])->middleware('auth:sanctum');
Route::patch('/counties/{id}', [CountiesController::class,'update'])->middleware('auth:sanctum');
Route::delete('/settlements/{id}', [SettlementsController::class,'destroy'])->middleware('auth:sanctum');
Route::delete('/counties/{id}', [CountiesController::class,'destroy'])->middleware('auth:sanctum');
Route::post('/counties/{id}/settlements/{id}', [SettlementsController::class,'store'])->middleware('auth:sanctum');
Route::patch('/counties/{id}/settlements/{id}', [SettlementsController::class,'update'])->middleware('auth:sanctum');
Route::delete('/counties/{id}/settlements/{id}', [SettlementsController::class,'destroy'])->middleware('auth:sanctum');
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
