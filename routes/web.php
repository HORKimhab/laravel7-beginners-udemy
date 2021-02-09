<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/starting_page', function () {
    return view('starting_page');
});

/* Route::get('/test/{id}/name/{name}', 'HobbyController@index');  */

// 'hobby' is name route
// More about Route::resource --> https://laravel.com/docs/7.x/controllers
Route::resource('hobby', 'HobbyController');
Route::resource('tag', 'TagController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
