<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
 
    Route::resource('admin/users', \App\Http\Controllers\UserController::class);
    Route::resource('admin/categorias', \App\Http\Controllers\TagController::class)->parameters([
        'categorias' => 'category'
    ]);
    Route::resource('admin/subcategorias', \App\Http\Controllers\SubcategoryController::class)->parameters([
        'subcategorias' => 'subcategory'
    ]);
    Route::resource('admin/products', \App\Http\Controllers\ProductController::class);
   
});
