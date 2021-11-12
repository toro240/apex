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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('login');


Route::middleware(['auth'])->group(function () {
    Route::get('/changePassword', 'ChangePasswordController@index')->name('changePassword');
    Route::post('/changePassword', 'ChangePasswordController@update')->name('changePassword.update');

    Route::middleware(['check.is_changed_password', 'set_group'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('/group/create', 'Groups\GroupController@create')->name('group.create');
        Route::post('/group', 'Groups\GroupController@store')->name('group.store');
        Route::get('/group/edit/{id}', 'Groups\GroupController@edit')->name('group.edit');
        Route::post('/group/update/{id}', 'Groups\GroupController@update')->name('group.update');
        Route::get('/group/change', 'Groups\GroupController@change')->name('group.change');
        Route::post('/group/change', 'Groups\GroupController@doChange')->name('group.doChange');
    });
});


