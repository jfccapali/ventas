<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/categoria/index',[CategoriaController::class,'index'])->name('categoria.index');
Route::get('/categoria/create',[CategoriaController::class,'create'])->name('categoria.create');
Route::post('/categoria/store',[CategoriaController::class,'store'])->name('categoria.store');
Route::get('/categoria/{id_categoria}/edit',[CategoriaController::class,'edit'])->name('categoria.edit');
Route::delete('/categoria/delete/{id_categoria}',[CategoriaController::class,'delete'])->name('categoria.delete');
