<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Backend\V1\Controller\UserController;

/*
|--------------------------------------------------------------------------
| Users Route
|--------------------------------------------------------------------------
| To reduce bloating of api and ensure readability a versioning of the 
| route is made and each file name will contain its own 
| route name
*/

// Route::middleware('auth:sanctum')->group( function () {
  Route::post('/users', [UserController::class, 'create']);
  Route::get('/users', [UserController::class, 'table']);
// });

//Auth
Route::post('/login', [UserController::class, 'login']);