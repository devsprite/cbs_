<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

// Authentication routes...
Route::get('/auth/login', [
    'as' => 'login',
    'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('/auth/login', [
    'as' => 'postLogin',
    'uses' => 'Auth\AuthController@postLogin'
]);

Route::get('/auth/logout', [
    'as' => 'logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

// Registration routes...
Route::post('/auth/register', [
    'as' => 'register',
    'uses' => 'Auth\AuthController@postRegister'
]);

Route::get('/form_upload', [
    'as' => 'form_upload',
    'uses' => 'FormUploadController@index'
]);

Route::post('/form_upload/', [
    'as' => 'form_upload',
    'uses' => 'FormUploadController@uploadFile'
]);

Route::get('/import', [
    'as' => 'import',
    'uses' => 'ImportController@importFile'
]);

Route::get('/showStats', [
    'as' => 'showStats',
    'uses' => 'BaseStatsController@showStats'
]);

Route::post('/showStats', [
    'as' => 'showStats',
    'uses' => 'BaseStatsController@postStats'
]);

Route::get('/modificationStats/{id}', [
    'as' => 'modificationStats',
    'uses' => 'BaseStatsController@modificationStats'
]);

Route::get('/showDatasOperateurs', [
    'as' => 'showDatasOperateurs',
    'uses' => 'BaseStatsController@showDatasOperateurs'
]);

Route::get('/showDefautsAutomate', [
    'as' => 'showDefautsAutomate',
    'uses' => 'BaseStatsController@showDefautsAutomate'
]);

Route::get('/mobiles', [
    'as' => 'mobiles',
    'uses' => 'MobilesController@index'
]);

Route::get('/tomographe', [
    'as' => 'tomographe',
    'uses' => 'TomoController@index'
]);

Route::get('/mdu', [
    'as' => 'mdu',
    'uses' => 'MduController@index'
]);

Route::post('/mdu', [
    'as' => 'mdu',
    'uses' => 'MduController@post'
]);


Route::get('/collecteurs/{ligne?}', [
    'as' => 'collecteurs',
    'uses' => 'CollecteursController@index'
]);

Route::post('/collecteurs/{ligne?}', [
    'as' => 'collecteursPost',
    'uses' => 'CollecteursController@post'
]);

Route::post('/recherche', [
    'as' => 'recherche',
    'uses' => 'RechercheController@postAjax'
]);

Route::get('/stats/{materiel?}', [
    'as' => 'stats',
    'uses' => 'StatsController@index'
]);

Route::post('/checkResults', [
    'as' => 'checkResults',
    'uses' => 'CheckResultsController@post'
]);