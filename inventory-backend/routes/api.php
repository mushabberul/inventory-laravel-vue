<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\SystemSettingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->group(function(){
    Route::post('login','login');
});

Route::middleware('auth:sanctum')->group(function(){
    //General Setting
    Route::apiResource('system-setting',SystemSettingController::class)->only(['index','update']);
    //Category
    Route::post('category-status/{id}',[CategoryController::class,'status']);
    Route::get('all-categories',[CategoryController::class,'allCategories']);
    Route::apiResource('categories',CategoryController::class);
});
