<?php

use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\QuestionController;
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


Route::prefix('achievements')->group(function(){
    Route::post('store',[AchievementsController::class , 'store']);
    Route::get('show',[AchievementsController::class , 'show']);
    Route::get('delete/{id}',[AchievementsController::class , 'destroy']);
    Route::post('update/{id}',[AchievementsController::class ,'update']);
});

Route::prefix('plans')->group(function(){
    Route::post('store',[PlanController::class , 'store']);
    Route::get('show',[PlanController::class , 'show']);
    Route::get('delete/{id}',[PlanController::class , 'destroy']);
    Route::post('update/{id}',[PlanController::class ,'update']);
});

Route::prefix('faqs')->group(function(){
    Route::post('store',[FAQController::class , 'store']);
    Route::get('show',[FAQController::class , 'show']);
    Route::get('delete/{id}',[FAQController::class , 'destroy']);
    Route::post('update/{id}',[FAQController::class ,'update']);
});


Route::prefix('news')->group(function(){
    Route::post('store',[NewsController::class , 'store']);
    Route::get('show',[NewsController::class , 'show']);
    Route::get('latest',[NewsController::class , 'latest']);
    Route::get('delete/{id}',[NewsController::class , 'destroy']);
    Route::get('detail/{slug}',[NewsController::class , 'detail']);
    Route::post('update/{id}',[NewsController::class ,'update']);
});

Route::prefix('question')->group(function(){
    Route::post('store',[QuestionController::class , 'store']);
    Route::get('show',[QuestionController::class , 'show']);
});

Route::prefix('content')->group(function(){
    Route::post('store',[ContentController::class , 'store']);
    Route::get('show/{section}',[ContentController::class , 'show']);
});

Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');
