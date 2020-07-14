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

Route::get('/', 'SectionController@index');

Route::get('/todo/create', 'TodoController@create');
Route::post('/todo', 'TodoController@store');
Route::put('/todo/{todo}/ready', 'TodoController@updateReadyMark');
Route::delete('/todo/{todo}', 'TodoController@delete');
Route::put('/todo/{todo}', 'TodoController@update');

Route::post('/section', 'SectionController@store');
Route::get('/section/{section}', 'SectionController@show');
Route::delete('/section/{section}', 'SectionController@delete');
