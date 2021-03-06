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
    return redirect('home');
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

        Route::get('/group/change', 'Groups\ChangeController@index')->name('group.change.index');
        Route::post('/group/change', 'Groups\ChangeController@update')->name('group.change.update');

        Route::get('/task/create', 'Tasks\TaskController@create')->name('task.create');
        Route::post('/task', 'Tasks\TaskController@store')->name('task.store');
        Route::get('/task/edit/{id}', 'Tasks\TaskController@edit')->name('task.edit');
        Route::post('/task/update/{id}', 'Tasks\TaskController@update')->name('task.update');
        Route::post('/task/removeMe/{id}', 'Tasks\TaskController@removeMe')->name('task.removeMe');
        Route::post('/task/destroy/{id}', 'Tasks\TaskController@destroy')->name('task.destroy');
    });
});


