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

Route::get('/', function () {
    return view('page.index');
});

Auth::routes();

Route::resource('/statuses', 'TaskStatusController')->except([
    'show'
]);

Route::get('/tasks/create/{defaultTaskStatus?}', 'TaskController@create')->name('tasks.create');

Route::resource('/tasks', 'TaskController')->except([
    'create'
]);



Route::resource('/users', 'UserController')->except([
    'create'
]);

Route::get('/home', 'HomeController@index')->name('home');
