<?php
use Adldap\Laravel\Facades\Adldap;
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


Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
 ]);
 
 Route::get('/', function () {
    return view('auth/login');
})->middleware('guest');

Route::get('/home','UserController@index');

Auth::routes();

Route::get('/home/create','UserController@create')->middleware('auth');

Route::post('/home/create/user','UserController@store'); 

Route::get('/home/usuarios','UserController@confirmDelete')->middleware('auth');

Route::post('/home/usuario/destroy','UserController@destroy');

Route::post('/home/usuario/edit','UserController@edit');

Route::post('webservice', 'UserController@webservice');