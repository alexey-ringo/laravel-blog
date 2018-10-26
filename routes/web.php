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

//Группа роутов для админки
Route::group(['prefix' => 'a7dm0in3', 'namespace' => 'Admin', 'middleware' => ['auth'] ], function () {
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    //['as'=>'admin'] - префикс для полного имени в именнованном маршруте (напр - admin.category.create)
    //для исключения пересечения с др именнованными ресурсами
    Route::resource('/category', 'CategoryController', ['as'=>'admin']);
    //Route::resource('/article', 'ArticleController', ['as'=>'admin']);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
