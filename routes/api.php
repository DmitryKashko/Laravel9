<?php

use App\Http\Controllers\Api\BlockController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResources([
    'projects' => ProjectController::class,
]);

Route::get('/', [IndexController::class, 'index']);








/*
Route::apiResources([
    'apiProjects' => ProjectController::class,
    'apiBlocks' => BlockController::class,
    'apiUsers' => UserController::class,
    'apiRoles' => RoleController::class,
]);

Route::get('/apiMains', [\App\Http\Controllers\Api\MainController::class, 'index']);


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('registration', [AuthController::class, 'registration']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});*/















/*Route::group(['namespace' => 'Api'], function () {
    Route::apiResource('projects', 'ProjectController', array("as" => "api"));
});*/
