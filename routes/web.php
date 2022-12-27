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
    Route::match(['get', 'post'], '/create/course', 'CourseController@create');
    Route::match(['get', 'post'], '/edit/course/{id}', 'CourseController@edit');
    Route::get('/delete/course/{id}', 'CourseController@delete');
    Route::get('/delete-all/courses', 'CourseController@deleteAll');

    //News
    Route::get('/news', 'NewsController@index');
    Route::match(['get', 'post'], '/create/news', 'NewsController@create');
    Route::match(['get', 'post'], '/edit/news/{id}', 'NewsController@edit');
    Route::get('/delete/news/{id}', 'NewsController@delete');
    Route::get('/delete-all/news', 'NewsController@deleteAll');
    //Books
    Route::get('/books', 'BookController@index');
    Route::match(['get', 'post'], '/create/book', 'BookController@create');
    Route::match(['get', 'post'], '/edit/book/{id}', 'BookController@edit');
    Route::get('/delete/book/{id}', 'BookController@delete');
    Route::get('/delete-all/books', 'BookController@deleteAll');
    //Chapters Book
    Route::get('/chapters/book/{id}', 'ChapterBookController@index');
    Route::post('/create/chapter/book/{id}', 'ChapterBookController@create');
    Route::post('/edit/chapter/{id}', 'ChapterBookController@edit');
    Route::get('/delete/chapter/{id}', 'ChapterBookController@delete');
    Route::get('/delete-all/chapter-books', 'ChapterBookController@deleteAll');
    //Banner
    Route::match(['get','post'],'/banner', 'BannerController@index');
    //Survey
    Route::get('/surveys', 'SurveyController@index');
    Route::post('/create/survey', 'SurveyController@create');
    Route::post('/edit/survey/{id}', 'SurveyController@edit');
    Route::get('/delete/survey/{id}', 'SurveyController@delete');
    Route::get('/delete-all/surveys', 'SurveyController@deleteAll');
    //Questions
    Route::get('/questions/survey/{id}', 'QuestionController@index');
    Route::match(['get', 'post'],'/create/question/survey/{id}', 'QuestionController@create');
    Route::match(['get', 'post'],'/edit/question/{question_id}/survey/{id}', 'QuestionController@edit');
    Route::get('/delete/question/{id}', 'QuestionController@delete');
    Route::get('/delete-all/questions', 'QuestionController@deleteAll');
    //File Manager
    Route::prefix('laravel-filemanager')->group(function () {
      \UniSharp\LaravelFilemanager\Lfm::routes();
    });
  });
});