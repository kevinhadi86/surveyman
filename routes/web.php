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

Route::get('/home', 'UserController@showHome');
Route::get('/login', 'UserController@showLogin');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::post('/register', 'UserController@store');
Route::get('/surveylist','UserController@showSurveyList')->middleware(\App\Http\Middleware\LoginMiddleware::class);
Route::get('/history','UserController@showHistory')->middleware(\App\Http\Middleware\LoginMiddleware::class);
Route::get('/changeprofile','UserController@edit')->middleware(\App\Http\Middleware\LoginMiddleware::class);
Route::post('/changeprofile/{id}','UserController@update');

Route::post('/form','FormController@store');
Route::get('/form/{id}/question','QuestionController@index');
Route::get('/form/{id}/question/answer','AnswerController@create');
Route::delete('form/delete/{id}','FormController@destroy');

Route::get('/exchangepoints','WalletController@index')->middleware(\App\Http\Middleware\LoginMiddleware::class);
Route::post('/exchangepoints/{id}','WalletController@store');
Route::post('/exchangepoints/add/{id}','WalletController@add');
Route::post('/exchangepoints/sub/{id}','WalletController@sub');

//view answer
Route::get('/viewanswer','AnswerController@index');
Route::get('/viewdetail/{id}','AnswerController@show');
Route::get('/viewstatistic/{id}','AnswerController@statistic');

