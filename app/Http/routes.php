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

Route::group(['middleware' => ['web']], function () {
    //Authentication Routes
  	Route::get('auth/login', ['as'=>'login', 'uses'=>'Auth\AuthController@getLogin']);
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', ['as'=>'logout', 'uses'=>'Auth\AuthController@getLogout']);
    
    //Registration Routes
    Route::get('auth/register', ['as' => 'register', 'uses'=>'Auth\AuthController@getRegister']);
	Route::post('auth/register', 'Auth\AuthController@postRegister');

    //Password Reset Route
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    //User Authenticaton
    Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
    
    //Pages
    Route::get('/', ['as'=>'pages.welcome', 'uses'=>'PagesController@getIndex']);
    Route::get('/contact',['as'=>'pages.contact', 'uses'=>'PagesController@getContact']);
});

Route::group(array('before' => 'auth'), function(){
    //Bet
    Route::resource('bet', 'BetController');
    Route::get('bet/betCreate/{game}', ['as'=>'bet.betCreate', 'uses'=>'BetController@betCreate']);
    //Spiele
    Route::get('/spiele', ['as' => 'spiele', 'uses'=>'GameController@getIndex']);
    Route::get('/spiele/create', 'GameController@create');
    Route::post('/spiele', ['as'=>'spiele.store', 'uses'=>'GameController@store']);
});