<?php

use App\Http\Backend\V1\Controller\BranchController;
use App\Http\Backend\V1\Controller\BrandController;
use App\Http\Backend\V1\Controller\CategoryController;
use App\Http\Backend\V1\Controller\DepartmentController;
use App\Http\Backend\V1\Controller\UserController;
use App\Http\Backend\V1\Controller\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Branch Route
|--------------------------------------------------------------------------
| To reduce bloating of api and ensure readability a versioning of the 
| route is made and each file name will contain its own 
| route name
*/

// Route::middleware('auth:sanctum')->group( function () {
Route::post('/branch', [BranchController::class, 'create']);
Route::get('/branch', [BranchController::class, 'table']);
Route::get('/branch/dropdown', [BranchController::class, 'dropdown']);
Route::post('/branch/delete', [BranchController::class, 'delete']);
Route::post('/branch/status', [BranchController::class, 'status']);

Route::get('/category', [CategoryController::class, 'table']);
Route::get('/category/dropdown', [CategoryController::class, 'dropdown']);
Route::post('/category', [CategoryController::class, 'create']);
Route::post('/category/delete', [CategoryController::class, 'delete']);

Route::post('/users', [UserController::class, 'create']);
Route::get('/users', [UserController::class, 'table']);
Route::post('/users/delete', [UserController::class, 'delete']);
Route::post('/users/status', [UserController::class, 'status']);

Route::post('/item', [ItemController::class, 'create']);
Route::get('/item', [ItemController::class, 'table']);
Route::post('/item/status', [ItemController::class, 'status']);
Route::get('/item/dropdown/{id}', [ItemController::class, 'dropdown']);

Route::get('/department/dropdown', [DepartmentController::class, 'dropdown']);
Route::post('/department', [DepartmentController::class, 'create']);

Route::get('/brand/dropdown',[BrandController::class, 'dropdown']);
Route::post('/brand', [BrandController::class, 'create']);
// });

//Auth
Route::post('/login', [UserController::class, 'login']);

