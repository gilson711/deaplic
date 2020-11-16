<?php

use Illuminate\Support\Facades\Route;



//Auth::routes();
Auth::routes(['verify'=>true]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('usuarios', 'App\Http\Controllers\UserController');
Route::resource('roles', 'App\Http\Controllers\RoleController');
/*MIDDLEWARE
Route::resource('usuarios', 'App\Http\Controllers\UserController')->middleware('auth');
SIRVE PARA QUE UN USUARIO INICIE SESION Y PUEDA VER LOS REGISTROS, ES DECIR NO CUALQUIERA PODRA VER LOS REGISTROS
A MENOS QUE ESTE LOGEADO
*/


//RUTAS PARA NUESTRA SECCION DE NOTAS
Route::resource('/notas/todas', 'App\Http\Controllers\NotasController');
Route::get('/notas/favoritas', 'App\Http\Controllers\NotasController@favoritas');
Route::get('/notas/archivadas', 'App\Http\Controllers\NotasController@archivadas');
//FIN DE RUTAS SE SECCION DE NOTAS


//Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index']);
//Route::get('/usuarios/create', [App\Http\Controllers\UserController::class, 'create']);