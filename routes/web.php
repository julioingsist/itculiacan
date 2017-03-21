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
#Rutas para las materias
Route::get('/', 'carrerasController@cargarCarreras');
Route::get('/consultaMaterias/{id}', 'materiasController@cargarMaterias');
Route::get('/abrirPDF/{id}', 'materiasController@abrirPDF');
Route::get('/registrarMateria','materiasController@registrarMateria');
Route::post('/guardarMateria','materiasController@guardarMateria');
Route::get('/editarMateria/{carrera_id}/{id}','materiasController@editarMateria');
Route::post('/actualizarMateria/{id}','materiasController@actualizarMateria');
Route::get('/eliminarMateria/{carrera}/{id}','materiasController@eliminarMateria');

#Rutas para las carreras
Route::get('/registrarCarrera','carrerasController@registrarCarrera');
Route::post('/guardarCarrera','carrerasController@guardarCarrera');
