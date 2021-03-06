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
//{slug?} означает, что переменная может быть, а може и не быть
Route::get('/blog/category/{slug?}', 'BlogController@category')->name('category');
Route::get('/blog/article/{slug?}', 'BlogController@article')->name('article');


//Группа роутов для админки
//'prefix' => 'a7dm0in3' - URI-префикс для Админки
//'namespace' => 'Admin' - namespace для контроллеров Админки (папка Admin)
Route::group(['prefix' => 'a7dm0in3', 'namespace' => 'Admin', 'middleware' => ['auth'] ], function () {
    Route::get('/', 'DashboardController@dashboard')->name('admin.dashboard');
    //['as'=>'admin'] - префикс для полного имени в именнованном маршруте (напр - admin.category.create)
    //для исключения пересечения с др именнованными ресурсами
    Route::post('/image-upload', 'ImageController@upload')->name('admin.upload_img');
    Route::resource('/category', 'CategoryController', ['as'=>'admin']);
    Route::resource('/article', 'ArticleController', ['as'=>'admin']);
    Route::group(['prefix' => 'user_management', 'namespace' => 'UserManagement'], function() {
        Route::resource('/user', 'UserController', ['as' => 'admin.user_management']);
    });
    Route::group(['prefix' => 'rbac_management', 'namespace' => 'RbacManagement'], function() {
        Route::resource('/role', 'RoleController', ['as' => 'admin.rbac_management']);
        Route::resource('/permission', 'PermissionController', ['as' => 'admin.rbac_management']);
    });
});

Route::get('/', function () {
    return view('blog.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
