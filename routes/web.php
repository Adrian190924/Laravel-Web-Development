<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

//AFL-1
Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/store', 'store')->name('store');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/show/{id}', 'show')->name('show');

    //AFL-2
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
});