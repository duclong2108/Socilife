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

Route::prefix('admin')->namespace('Admin')->group(function () {
  Route::match(['get', 'post'], '/', 'AdminController@login')->name('login');
  Route::group(['middleware' => 'admin'], function () {
    //Admin
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/logout', 'AdminController@logout');
    Route::match(['get', 'post'], '/account', 'AdminController@account');
    //Course
    Route::get('/courses', 'CourseController@index');
    Route::get('/create/course', 'CourseController@create');

    //News
    Route::get('/news', 'NewsController@index');
    Route::get('create/news', 'NewsController@create');
    Route::match(['get', 'post'], '/create/course', 'CourseController@create');
    //File Manager
    Route::prefix('laravel-filemanager')->group(function () {
      \UniSharp\LaravelFilemanager\Lfm::routes();
    });
  });
});