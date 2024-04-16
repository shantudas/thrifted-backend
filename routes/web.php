<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ParentCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/api/users', UserController::class);
Route::resource('/api/categories', CategoryController::class);
Route::resource('/api/child-categories', ChildCategoryController::class);
Route::resource('/api/parent-categories', ParentCategoryController::class);


Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
