<?php

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
Route::get('/', 'carrerasController@cargarCarreras');
Route::get('/consultaMaterias/{id}', 'materiasController@cargarMaterias');
Route::get('/abrirPDF/{id}', 'materiasController@abrirPDF');
Route::get('/editarPrograma/{carrera_id}/{id}','materiasController@editarPrograma');
Route::get('/eliminarPrograma/{id}','materiasController@eliminarPrograma');
Route::get('/registrarMateria','materiasController@registrarMateria');
Route::get('/registrarPrograma','programasController@registrarPrograma');