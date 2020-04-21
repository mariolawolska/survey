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
    return view('layouts.frame.index');
});

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

Route::resource('survey', 'SurveyController');
Route::resource('question', 'QuestionController');
Route::resource('answer', 'AnswerController');

Route::get('/cardgame', 'CardGameController@index')->name('cardgame');
Route::get('/startGame', 'CardGameController@startGame')->name('startgame');
Route::get('/nextTurn', 'CardGameController@nextTurn')->name('nextturn');
