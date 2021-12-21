<?php

use App\Http\Middleware\Login;
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

Route::get('/login', 'LoginController@getLogin')->name('login');
Route::post('/login', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@logout')->name('logout');

// Admin
// Route::group(['prefix' => '/admin'], function () {
    Route::prefix('admin')->middleware('login')->group(function() {
    Route::get('/', 'HomeController@index')->name('admin');
    // User
    Route::get('/user', 'UsersController@getUser')->name('user');
    Route::post('/user/{id}', 'UsersController@editUser')->name('user.edit');

});

