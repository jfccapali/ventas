<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/categoria/index',[CategoriaController::class,'index'])->name('categoria.index')->middleware(['auth']);
Route::get('/categoria/create',[CategoriaController::class,'create'])->name('categoria.create')->middleware(['auth']);
Route::post('/categoria/store',[CategoriaController::class,'store'])->name('categoria.store')->middleware(['auth']);
Route::get('/categoria/{id_categoria}/edit',[CategoriaController::class,'edit'])->name('categoria.edit')->middleware(['auth']);
Route::put('/categoria/{id_categoria}/update',[CategoriaController::class,'update'])->name('categoria.update')->middleware(['auth']);
Route::delete('/categoria/delete/{id_categoria}',[CategoriaController::class,'delete'])->name('categoria.delete')->middleware(['auth']);


Route::get('/producto/index',[ProductoController::class,'index'])->name('producto.index')->middleware(['auth','can:producto.index']);
Route::get('/producto/create',[ProductoController::class,'create'])->name('producto.create')->middleware(['auth','can:producto.create']);
Route::post('/producto/store',[ProductoController::class,'store'])->name('producto.store')->middleware(['auth','can:producto.store']);
Route::get('/producto/{id_producto}/edit',[ProductoController::class,'edit'])->name('producto.edit')->middleware(['auth','can:producto.edit']);
Route::put('/producto/{id_producto}/update',[ProductoController::class,'update'])->name('producto.update')->middleware(['auth','can:producto.update']);
Route::delete('/producto/delete/{id_producto}',[ProductoController::class,'delete'])->name('producto.delete')->middleware(['auth','can:producto.delete']);

Route::get('/cliente/index',[ClienteController::class,'index'])->name('cliente.index')->middleware(['auth']);
Route::get('/cliente/create',[ClienteController::class,'create'])->name('cliente.create')->middleware(['auth']);
Route::post('/cliente/store',[ClienteController::class,'store'])->name('cliente.store')->middleware(['auth']);
Route::get('/cliente/{id_cliente}/edit',[ClienteController::class,'edit'])->name('cliente.edit')->middleware(['auth']);
Route::put('/cliente/{id_cliente}/update',[ClienteController::class,'update'])->name('cliente.update')->middleware(['auth']);
Route::delete('/cliente/delete/{id_cliente}',[ClienteController::class,'delete'])->name('cliente.delete')->middleware(['auth']);


Route::get('/login',[LoginController::class,'login'])->name('login')->middleware(['guest']);
Route::post('/login/login_verifica',[LoginController::class,'login_verifica'])->name('login.login_verifica')->middleware(['guest']);
Route::get('/logout',[LoginController::class,'logout'])->name('logout')->middleware(['auth']);
Route::get('/bienvenido',[LoginController::class,'index'])->name('bienvenido')->middleware(['auth','sexo']);
Route::get('/bienvenido_hombre',[LoginController::class,'index_hombre'])->name('bienvenido_hombre')->middleware(['auth']);
Route::get('/bienvenido_mujer',[LoginController::class,'index_mujer'])->name('bienvenido_mujer')->middleware(['auth']);


Route::get('/rol/index',[RolController::class,'index'])->name('rol.index')->middleware(['auth']);
Route::get('/rol/create',[RolController::class,'create'])->name('rol.create')->middleware(['auth']);
Route::post('/rol/store',[RolController::class,'store'])->name('rol.store')->middleware(['auth']);
Route::get('/rol/{id_rol}/edit',[RolController::class,'edit'])->name('rol.edit')->middleware(['auth']);
Route::put('/rol/{id_rol}/update',[RolController::class,'update'])->name('rol.update')->middleware(['auth']);
Route::delete('/rol/delete/{id_rol}',[RolController::class,'delete'])->name('rol.delete')->middleware(['auth']);
Route::get('/rol/asignar_permiso/{id_rol}',[RolController::class,'asignar_permiso'])->name('rol.asignar_permiso')->middleware(['auth']);
Route::post('/rol/asignar_permiso_store/{id_rol}',[RolController::class,'asignar_permiso_store'])->name('rol.asignar_permiso_store')->middleware(['auth']);

Route::get('/permiso/index',[PermisoController::class,'index'])->name('permiso.index')->middleware(['auth']);
Route::get('/permiso/create',[PermisoController::class,'create'])->name('permiso.create')->middleware(['auth']);
Route::post('/permiso/store',[PermisoController::class,'store'])->name('permiso.store')->middleware(['auth']);
Route::get('/permiso/{id_rol}/edit',[PermisoController::class,'edit'])->name('permiso.edit')->middleware(['auth']);
Route::put('/permiso/{id_rol}/update',[PermisoController::class,'update'])->name('permiso.update')->middleware(['auth']);
Route::delete('/permiso/delete/{id_rol}',[PermisoController::class,'delete'])->name('permiso.delete')->middleware(['auth']);

Route::get('/usuario/index',[UsuarioController::class,'index'])->name('usuario.index')->middleware(['auth']);
Route::get('/usuario/create',[UsuarioController::class,'create'])->name('usuario.create')->middleware(['auth']);
Route::post('/usuario/store',[UsuarioController::class,'store'])->name('usuario.store')->middleware(['auth']);
Route::get('/usuario/{id_usuario}/edit',[UsuarioController::class,'edit'])->name('usuario.edit')->middleware(['auth']);
Route::put('/usuario/{id_usuario}/update',[UsuarioController::class,'update'])->name('usuario.update')->middleware(['auth']);
Route::delete('/usuario/delete/{id_usuario}',[UsuarioController::class,'delete'])->name('usuario.delete')->middleware(['auth']);
Route::get('/usuario/asignar_roles/{id_usuario}',[UsuarioController::class,'asignar_roles'])->name('usuario.asignar_roles')->middleware(['auth']);
Route::post('/usuario/asignar_roles_store/{id_usuario}',[UsuarioController::class,'asignar_roles_store'])->name('usuario.asignar_roles_store')->middleware(['auth']);


Route::get('/venta/registrar_venta',[VentaController::class,'registrar_venta'])->name('venta.registrar_venta')->middleware(['auth']);
Route::post('/venta/registrar_venta_store',[VentaController::class,'registrar_venta_store'])->name('venta.registrar_venta_store')->middleware(['auth']);
Route::get('/venta/reporte',[VentaController::class,'reporte'])->name('venta.reporte')->middleware(['auth']);


//peticiones json
Route::get('/cliente/list_clientes',[ClienteController::class,'list_clientes'])->name('cliente.list_clientes')->middleware(['auth']);
Route::get('/producto/list_productos',[ProductoController::class,'list_productos'])->name('producto.list_productos')->middleware(['auth']);

//reporte
Route::get('/reporte/reporte_ventas',[ReporteController::class,'reporte_ventas'])->name('reporte.reporte_ventas')->middleware(['auth']);

//pdf
Route::get('/pdf/reporte_ventas',[PdfController::class,'reporte_ventas'])->name('pdf.reporte_ventas')->middleware(['auth']);
