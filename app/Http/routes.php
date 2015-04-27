<?php
use App\Services\MovieDB;
use Illuminate\Http\Request;

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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('/index', 'MoviesController@search');

Route::get('/result','MoviesController@result');

Route::get('/update', 'MoviesController@update');

Route::get('token', function() {
    echo csrf_token();
});

Route::get('search', ['as' => 'search', 'uses' => 'MoviesController@search']);
