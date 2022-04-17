<?php

use Illuminate\Support\Facades\Route;

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

// Route::group(['middleware' => 'auth'], function () {

// });

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
// Route::get('/user_management', 'App\Http\Controllers\UserController@view')->name('user-management');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('user-management', ['as' => 'user.view', 'uses' => 'App\Http\Controllers\UserController@view']);
	Route::get('profile/{id}', ['as' => 'profile.show', 'uses' => 'App\Http\Controllers\ProfileController@show']);
	Route::get('user-delete/{user}', ['as' => 'user.delete', 'uses' => 'App\Http\Controllers\UserController@destroy']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::get('house-rent', ['as' => 'rent.list', 'uses' => 'App\Http\Controllers\HouseRentController@index']);
Route::get('house-rent-add', ['as' => 'rent.add', 'uses' => 'App\Http\Controllers\HouseRentController@create']);
Route::put('house-rent-add', ['as' => 'rent.store', 'uses' => 'App\Http\Controllers\HouseRentController@store']);
Route::get('house-rent-edit/{houseRent}', ['as' => 'rent.edit', 'uses' => 'App\Http\Controllers\HouseRentController@edit']);
Route::get('house-rent-delete/{houseRent}', ['as' => 'rent.delete', 'uses' => 'App\Http\Controllers\HouseRentController@destroy']);

