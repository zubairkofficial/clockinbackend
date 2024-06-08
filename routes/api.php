<?php

use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::post('/upload-image' , [ImageController::class,'store']);
Route::get('/get-image/{section}/{mode}',[ImageController::class,'getimage']);

Route::post('/addfeature',[FeatureController::class,'add']);
Route::get('/getfeature',[FeatureController::class,'show']);
Route::get('/deletefeature/{id}',[FeatureController::class,'delete']);
Route::post('/updatefeature/{id}',[FeatureController::class,'update']);
Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');
