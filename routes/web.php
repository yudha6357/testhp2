<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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


Auth::routes();


Route::group(['middleware' => ['auth']], function() {
    Route::get(
        '/',
        [HomeController::class, 'index']
        );
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// category
    Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    Route::post('/add/category', [App\Http\Controllers\CategoryController::class, 'create'])->name('add.category');
    Route::get('/edit/category', [App\Http\Controllers\CategoryController::class, 'edit'])->name('edit.category');
    Route::post('/update/category', [App\Http\Controllers\CategoryController::class, 'update'])->name('update.category');
    Route::delete('/destroy/category/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('destroy.category');
    //    Transaction
    Route::get('/transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
    Route::post('/add/transaction', [App\Http\Controllers\TransactionController::class, 'create'])->name('add.transaction');
    Route::get('/edit/transaction', [App\Http\Controllers\TransactionController::class, 'edit'])->name('edit.transaction');
    Route::post('/update/transaction', [App\Http\Controllers\TransactionController::class, 'update'])->name('update.transaction');
    Route::delete('/destroy/transaction/{id}', [App\Http\Controllers\TransactionController::class, 'destroy'])->name('destroy.transaction');
    Route::post('/filter/transaction/', [App\Http\Controllers\TransactionController::class, 'filter'])->name('filter.transaction');
 });
