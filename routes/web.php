<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolController;
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


Route::get('/producto/index',[ProductoController::class,'index'])->name('producto.index')->middleware(['auth','can:producto.index']);
Route::get('/producto/create',[ProductoController::class,'create'])->name('producto.create')->middleware(['auth','can:producto.create']);
Route::post('/producto/store',[ProductoController::class,'store'])->name('producto.store')->middleware(['auth','can:producto.store']);
Route::get('/producto/{id_producto}/edit',[ProductoController::class,'edit'])->name('producto.edit')->middleware(['auth','can:producto.edit']);
Route::put('/producto/{id_producto}/update',[ProductoController::class,'update'])->name('producto.update')->middleware(['auth','can:producto.update']);
Route::delete('/producto/delete/{id_producto}',[ProductoController::class,'delete'])->name('producto.delete')->middleware(['auth','can:producto.delete']);

Route::get('/cliente/index',[ClienteController::class,'index'])->name('cliente.index')->middleware(['auth']);
Route::get('/cliente/create',[ClienteController::class,'create'])->name('cliente.create');
Route::post('/cliente/store',[ClienteController::class,'store'])->name('cliente.store');
Route::get('/cliente/{id_cliente}/edit',[ClienteController::class,'edit'])->name('cliente.edit');
Route::put('/cliente/{id_cliente}/update',[ClienteController::class,'update'])->name('cliente.update');
Route::delete('/cliente/delete/{id_cliente}',[ClienteController::class,'delete'])->name('cliente.delete');


Route::get('/login',[LoginController::class,'login'])->name('login')->middleware(['guest']);
Route::post('/login/login_verifica',[LoginController::class,'login_verifica'])->name('login.login_verifica');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/bienvenido',[LoginController::class,'index'])->name('bienvenido');


Route::get('/rol/index',[RolController::class,'index'])->name('rol.index');
Route::get('/rol/create',[RolController::class,'create'])->name('rol.create');
Route::post('/rol/store',[RolController::class,'store'])->name('rol.store');
Route::get('/rol/{id_rol}/edit',[RolController::class,'edit'])->name('rol.edit');
Route::put('/rol/{id_rol}/update',[RolController::class,'update'])->name('rol.update');
Route::delete('/rol/delete/{id_rol}',[RolController::class,'delete'])->name('rol.delete');
Route::get('/rol/asignar_permiso/{id_rol}',[RolController::class,'asignar_permiso'])->name('rol.asignar_permiso');
Route::post('/rol/asignar_permiso_store/{id_rol}',[RolController::class,'asignar_permiso_store'])->name('rol.asignar_permiso_store');

Route::get('/permiso/index',[PermisoController::class,'index'])->name('permiso.index');
Route::get('/permiso/create',[PermisoController::class,'create'])->name('permiso.create');
Route::post('/permiso/store',[PermisoController::class,'store'])->name('permiso.store');
Route::get('/permiso/{id_rol}/edit',[PermisoController::class,'edit'])->name('permiso.edit');
Route::put('/permiso/{id_rol}/update',[PermisoController::class,'update'])->name('permiso.update');
Route::delete('/permiso/delete/{id_rol}',[PermisoController::class,'delete'])->name('permiso.delete');
