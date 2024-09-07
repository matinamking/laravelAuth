<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/',[AdminController::class,'index'])->name('admin')->middleware('auth');
    Route::post('/store',[AdminController::class,'store'])->name('admin.store')->middleware('auth');
    Route::patch('/update/{user}',[AdminController::class,'update'])->name('admin.update')->middleware('auth');
    Route::delete('/destroy/{user}',[AdminController::class,'destroy'])->name('admin.destroy')->middleware('auth');
});
