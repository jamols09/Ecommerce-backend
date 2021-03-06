<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::middleware('auth:sanctum')->get('backend/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'backend/v1',
], function ($routes) {
    require __DIR__.'/backend/v1/api.php';
    // require __DIR__.'/backend/v1/UsersRoute.php';
    // require __DIR__.'/backend/v1/BranchRoute.php';
    // require __DIR__.'/backend/v1/CategoryRoute.php';
});

// Route::group([
//     'prefix' => 'frontend/v1',
// ], function ($routes) {
//     require __DIR__.'/backend/v1/UsersRoute.php';
//     require __DIR__.'/backend/v1/BranchRoute.php';
// });