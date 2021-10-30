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
    return view('welcome');
});


Auth::routes();

Route::get('/index','IndexController@index')->name('index');
Route::post('/store','IndexController@store')->name('store');
Route::get('/index2','IndexController@move')->name('index2');
Route::get('/get_json','IndexController@get');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/questionnaire','IndexController@show')->name('questionnaire');
Route::post('/questionnaire/store1','IndexController@store1')->name('store1');

Route::get('/teachers','IndexController@teachers')->name('teachers');
Route::post('/teachers/store2','IndexController@store2')->name('store2');

Route::post('/teachers/send','IndexController@send')->name('send');

Route::get('/csvimport_index', 'CSVimportsController@index')->name('csvimport_index');
Route::post('/import', 'CSVimportsController@import')->name('csvimport_index');
