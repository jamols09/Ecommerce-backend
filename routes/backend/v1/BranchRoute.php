<?php

use App\Http\Backend\V1\Controller\BranchController;
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
  Route::get('/branch/dropdown', [BranchController::class, 'getDropdown']);
  
// });

