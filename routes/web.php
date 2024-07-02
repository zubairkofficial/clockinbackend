<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/refresh',[MigrationController::class,'refresh']);