<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CustomarController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\SupplierController;
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
    //Brand
    Route::post('brand-status/{id}',[BrandController::class,'status']);
    Route::get('all-brands',[BrandController::class,'allBrands']);
    Route::apiResource('brands',BrandController::class);
    //Supplier
    Route::post('customar-status/{id}',[SupplierController::class,'status']);
    Route::get('all-suppliers',[SupplierController::class,'allSuppliers']);
    Route::apiResource('suppliers',SupplierController::class);
    //Customar
    Route::post('customar-status/{id}',[CustomarController::class,'status']);
    Route::get('all-customars',[CustomarController::class,'allCustomars']);
    Route::apiResource('customars',CustomarController::class);
    //Staff
    Route::post('staff-status/{id}',[StaffController::class,'status']);
    Route::get('all-staffs',[StaffController::class,'allStaffs']);
    Route::apiResource('staffs',StaffController::class);
    //Product
    Route::post('product-status/{id}',[ProductController::class,'status']);
    Route::get('all-products',[ProductController::class,'allProducts']);
    Route::apiResource('products',ProductController::class);
    //Expense Category
    Route::get('all-expense-categoris',[ExpenseCategoryController::class,'allExpenseCategorys']);
    Route::apiResource('expense-categoris',ExpenseCategoryController::class);
    //Expense
    Route::get('all-expense',[ExpenseController::class,'allExpenses']);
    Route::apiResource('expenses',ExpenseController::class);

});
