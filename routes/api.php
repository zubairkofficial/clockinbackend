<?php

use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::post('/upload-image' , [ImageController::class,'store']);
Route::post('/get-image',[ImageController::class,'getimage']);

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

Route::prefix('footer')->group(function(){
    Route::post('store',[FooterController::class , 'store']);
    Route::get('show',[FooterController::class , 'show']);
    Route::get('delete/{id}',[FooterController::class , 'destroy']);
    Route::post('update/{id}',[FooterController::class ,'update']);
});
Route::prefix('download')->group(function(){
    Route::post('store',[DownloadController::class , 'store']);
    Route::get('show',[DownloadController::class , 'show']);
    Route::get('delete/{id}',[DownloadController::class , 'destroy']);
    Route::post('update/{id}',[DownloadController::class ,'update']);
    Route::get('download-file',[DownloadController::class,'download']);
});

Route::prefix('stat')->group(function(){
    Route::post('store',[StatController::class , 'store']);
    Route::get('show',[StatController::class , 'show']);
    Route::get('delete/{id}',[StatController::class , 'destroy']);
    Route::post('update/{id}', [StatController::class, 'update']);

});
Route::prefix('privacy')->group(function(){
    Route::post('store',[PrivacyController::class , 'store']);
    Route::get('show',[PrivacyController::class , 'show']);
    Route::get('delete/{id}',[PrivacyController::class , 'destroy']);
    Route::post('update/{id}', [PrivacyController::class, 'update']);

});
Route::prefix('term')->group(function(){
    Route::post('store',[TermController::class , 'store']);
    Route::get('show',[TermController::class , 'show']);
    Route::get('delete/{id}',[TermController::class , 'destroy']);
    Route::post('update/{id}', [TermController::class, 'update']);

});

Route::prefix('seo')->group(function(){
    Route::post('update/{id}', [SEOController::class, 'update']);
    Route::post('store',[SEOController::class , 'store']);
    Route::get('show',[SEOController::class , 'show']);
    Route::get('showadmin',[SEOController::class , 'showadmin']);
    Route::get('delete/{id}',[SEOController::class , 'destroy']);
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
    Route::get('show',[ContentController::class , 'show']);
});
Route::prefix('page')->group(function(){
    Route::post('store',[PageController::class , 'store']);
    Route::get('show/{page_id}',[PageController::class , 'show']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
