<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


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

Route::get('/', 'App\Http\Controllers\LoginController@index')->name('loginForm');
Route::get('/register', 'App\Http\Controllers\RegisterController@index')->name('registerForm');
Route::post('login', 'App\Http\Controllers\LoginController@checkLogin')->name('loginSubmit');
Route::get('/', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::get('/form-edit-profile', 'App\Http\Controllers\LoginController@formEditProfile');
Route::post('/edit-profile', 'App\Http\Controllers\LoginController@editProfile');

Route::get('dashboard', 'App\Http\Controllers\LoginController@showDashboard')->name('dashboard');
Route::post('register-submit', 'App\Http\Controllers\RegisterController@registerSubmit')->name('registerSubmit');
Route::post('/tool/calculate-and-get-density', 'App\Http\Controllers\ToolController@CalculateAndGetDensity');
Route::post('/tool/calculate-plagiarism', 'App\Http\Controllers\ToolController@CalculatePlagiarism');
