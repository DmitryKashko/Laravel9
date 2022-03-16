<?php

use App\Http\Controllers\Web\BlockController;
use App\Http\Controllers\Web\DownloadController;
use App\Http\Controllers\Web\MainController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.creat');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/main', [MainController::class, 'index'])->name('welcome');
    Route::get('/main/{id}', [MainController::class, 'show'])->name('show');
    Route::get('/download', [DownloadController::class, 'downloads'])->name('download');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');


    Route::resources([
        '/projects' => ProjectController::class,
        '/blocks' => BlockController::class,
    ]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/download', [DownloadController::class, 'downloads'])->name('download');
});



    Route::group(['middleware' => 'admin'], function () {
        Route::resources([
            '/users' => UsersController::class,
        ]);
    });
});

