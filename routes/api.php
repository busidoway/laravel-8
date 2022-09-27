<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormFeedback;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\MenuController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('feedback', [FormFeedback::class, 'index']);

Route::get('user_video/users', [VideoController::class, 'getUsers']);

Route::get('user_video/{video}', [VideoController::class, 'getUserVideo']);

Route::get('store_user_video/{video}', [VideoController::class, 'storeUserVideo']);

Route::get('menu/list', [MenuController::class, 'getMenuList']);