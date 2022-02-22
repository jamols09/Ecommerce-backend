<?php

use App\Http\Backend\V1\Controller\BranchController;
use App\Http\Backend\V1\Controller\BrandController;
use App\Http\Backend\V1\Controller\CategoryController;
use App\Http\Backend\V1\Controller\DepartmentController;
use App\Http\Backend\V1\Controller\UserController;
use App\Http\Backend\V1\Controller\ItemController;
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
Route::prefix('branch')->group(function () {
    Route::post('', [BranchController::class, 'create']);
    Route::get('', [BranchController::class, 'table']);
    Route::get('dropdown', [BranchController::class, 'dropdown']);
    Route::post('delete', [BranchController::class, 'destroy']);
    Route::post('status', [BranchController::class, 'status']);
    Route::get('{id}', [BranchController::class, 'show']);
    Route::patch('{id}', [BranchController::class, 'update']);
    Route::get('items', [BranchController::class, 'itemsPerBranchTable']);
});

Route::prefix('category')->group(function () {
    Route::get('', [CategoryController::class, 'table']);
    Route::get('dropdown', [CategoryController::class, 'dropdown']);
    Route::post('', [CategoryController::class, 'create']);
    Route::post('delete', [CategoryController::class, 'destroy']);
    Route::get('{id}', [CategoryController::class, 'show']);
    Route::patch('{id}', [CategoryController::class, 'update']);
});

Route::prefix('users')->group(function () {
    Route::post('', [UserController::class, 'create']);
    Route::get('', [UserController::class, 'table']);
    Route::post('delete', [UserController::class, 'delete']);
    Route::post('status', [UserController::class, 'status']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::patch('{id}', [UserController::class, 'update']);
});

Route::prefix('item')->group(function () {
    Route::post('', [ItemController::class, 'create']);
    Route::get('', [ItemController::class, 'table']);
    Route::post('status', [ItemController::class, 'status']);
    Route::get('dropdown/{id}', [ItemController::class, 'dropdown']);
});

Route::get('department/dropdown', [DepartmentController::class, 'dropdown']);
Route::post('department', [DepartmentController::class, 'create']);

Route::get('brand/dropdown', [BrandController::class, 'dropdown']);
Route::post('brand', [BrandController::class, 'create']);
// });

//Auth
Route::post('/login', [UserController::class, 'login']);
