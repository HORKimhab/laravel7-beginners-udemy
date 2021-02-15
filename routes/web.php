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
Route::resource('hobby', 'HobbyController')/* ->middleware('auth') */; // middleare('auth') // must login
Route::resource('tag', 'TagController');
Route::resource('user', 'UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/hobby/tag/{tag_id}', 'HobbyTagController@getFilteredHobbies')->name('hobby_tag');

// Detach | Attach function
Route::get('/hobby/{hobby_id}/tag/{tag_id}/detach', 'HobbyTagController@detachTag')->name('detachTag');
Route::get('/hobby/{hobby_id}/tag/{tag_id}/attach', 'HobbyTagController@attachTag')->name('attachTag');

// Delete Image in hobby
Route::get('/delete-image/hobby/{hobby_id}', 'HobbyController@deleteImage')->name('deleteImageHobby');

// Delete Image in user
Route::get('/delete-image/user/{user_id}', 'UserController@deleteImage')->name('deleteImageUser');