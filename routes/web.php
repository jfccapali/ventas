<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/categoria/index',[CategoriaController::class,'index'])->name('categoria.index');
Route::get('/categoria/create',[CategoriaController::class,'create'])->name('categoria.create');
Route::post('/categoria/store',[CategoriaController::class,'store'])->name('categoria.store');
Route::get('/categoria/{id_categoria}/edit',[CategoriaController::class,'edit'])->name('categoria.edit');
Route::put('/categoria/{id_categoria}/update',[CategoriaController::class,'update'])->name('categoria.update');
Route::delete('/categoria/delete/{id_categoria}',[CategoriaController::class,'delete'])->name('categoria.delete');


Route::get('/producto/index',[ProductoController::class,'index'])->name('producto.index');
Route::get('/producto/create',[ProductoController::class,'create'])->name('producto.create');
Route::post('/producto/store',[ProductoController::class,'store'])->name('producto.store');
Route::get('/producto/{id_producto}/edit',[ProductoController::class,'edit'])->name('producto.edit');
Route::put('/producto/{id_producto}/update',[ProductoController::class,'update'])->name('producto.update');
Route::delete('/producto/delete/{id_producto}',[ProductoController::class,'delete'])->name('producto.delete');

Route::get('/cliente/index',[ClienteController::class,'index'])->name('cliente.index');
Route::get('/cliente/create',[ClienteController::class,'create'])->name('cliente.create');
Route::post('/cliente/store',[ClienteController::class,'store'])->name('cliente.store');
Route::get('/cliente/{id_cliente}/edit',[ClienteController::class,'edit'])->name('cliente.edit');
Route::put('/cliente/{id_cliente}/update',[ClienteController::class,'update'])->name('cliente.update');
Route::delete('/cliente/delete/{id_cliente}',[ClienteController::class,'delete'])->name('cliente.delete');
