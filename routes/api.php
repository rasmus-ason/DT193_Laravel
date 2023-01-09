<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Adding paths to controllers
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AmountChangeLogController;
use App\Http\Controllers\ReportMessageController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Add routes to protected API's 
Route::resource('products', ProductController::class)->middleware('auth:sanctum');
Route::resource('amountchangelog', AmountChangeLogController::class)->middleware('auth:sanctum');
Route::resource('reportmessage', ReportMessageController::class)->middleware('auth:sanctum');
Route::resource('productcategories', ProductCategoriesController::class)->middleware('auth:sanctum');

//Route for registration and login
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register'] );
Route::post('/login', [AuthController::class, 'login'] );

//Check if category contains products
Route::get('productcategories/category/{categoryname}', [ProductCategoriesController::class , 'getCategoryName']);
//Update table Products column product_category
Route::put('productcategories/category/{categoryname}', [ProductCategoriesController::class , 'updateCategoryOnProduct']);

//Search
Route::get('/amountchangelog/search/latest', [AmountChangeLogController::class, 'latestLogs']);
Route::get('/amountchangelog/search/articlenumber/{article}', [AmountChangeLogController::class, 'searchArticleNumber']);
Route::get('/reportmessage/search/articlenumber/{article}', [ReportMessageController::class, 'searchArticleNumber']);
Route::get('/products/search/articlenumber/{article}', [ProductController::class, 'searchArticleNumber']);
Route::get('/products/search/status/{status}', [ProductController::class, 'searchStatus']);
Route::get('/products/search/productname/{productname}', [ProductController::class, 'searchProductName']);
Route::get('/products/search/categoryname/{categoryname}', [ProductController::class, 'searchCategoryName']);
Route::get('/products/search/productcategory/{productcategory}', [ProductController::class, 'searchProductCategory']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
