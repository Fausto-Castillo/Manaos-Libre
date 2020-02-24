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


// {asd?} = asd parametro optativo



Route::get('/', 'ProductosController@home');


//PRODUCTOS 

Route::get('productos/{busqueda?}', 'ProductosController@listado')->name('productos');

Route::get('producto/{id}', 'ProductosController@detalle');

Route::get('productos/baratos', 'ProductosController@baratos');

Route::get('perfil', function () {
    return view('perfil');});

Route::get('perfil/{id}', 'UsuariosController@perfil');

Route::get('actualizarPerfil', 'UsuariosController@actualizar');

Route::get('crearPublicacion', 'ProductosController@nuevoProducto');

Route::post('crearPublicacion','ProductosController@crear'); 

Route::post('borrarPublicacion','ProductosController@borrar'); 


Route::get('ciudades', 'CiudadesController@listado');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'ProductosController@home')->name('home');

Route::get('/test/{busqueda?}', 'ProductosController@listado');