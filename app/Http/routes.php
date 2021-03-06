<?php
use App\Services\MovieDB;
use Illuminate\Http\Request;
use App\Models\Recipes;

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

Route::get('/save', 'MoviesController@save');

Route::get('/delete/{id}', 'MoviesController@delete');

Route::get('/delete_user/{id}', 'MoviesController@delete_user');

Route::get('/movielist', 'MoviesController@show');

Route::get('/admin', 'MoviesController@admin');


Route::get('token', function() {
    echo csrf_token();
});

Route::controllers ([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);