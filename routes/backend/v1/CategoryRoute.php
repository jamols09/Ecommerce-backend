<?php

use App\Http\Backend\V1\Controller\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Category Route
|--------------------------------------------------------------------------
| To reduce bloating of api and ensure readability a versioning of the 
| route is made and each file name will contain its own 
| route name
*/

// Route::middleware('auth:sanctum')->group( function () {
  Route::get('/category', [CategoryController::class, 'getAll']);
  Route::get('/category/dropdown', [CategoryController::class, 'getDropdown']);
  Route::post('/category', [CategoryController::class, 'create']);
  Route::post('/category/delete',[CategoryController::class, 'delete']);
  
// });

