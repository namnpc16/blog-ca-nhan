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

// Route::get('/', function () {
//     return view('welcome');
// });

// frontend
Route::group(['prefix' => '/', 'namespace' => 'frontend'], function () {
    Route::get('/', 'FrontendController@home')->name('index');
    Route::get('about', 'FrontendController@about')->name('about');
    Route::get('contact', 'FrontendController@contact')->name('contact');
    Route::get('post/{slug}', 'FrontendController@standart')->name('post');

    Route::get('category/{slug}', 'FrontendController@category')->name('category');
});



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
});
// trang quản trị
Route::group(['prefix' => '/admin', 'namespace' => 'admin'], function () {
    Route::get('dasboard', 'AdminController@index')->name('dashboard');

    Route::get('post', 'PostsController@index')->name('post.index');
    Route::get('post/create', 'PostsController@create')->name('post.create');
    Route::post('post/store', 'PostsController@store')->name('post.store');
    Route::get('post/edit/{id}', 'PostsController@edit')->name('post.edit');
    Route::post('post/update/{id}', 'PostsController@update')->name('post.update');
    Route::post('post/destroy', 'PostsController@destroy')->name('post.destroy');

    Route::get('user', 'UsersController@index')->name('user.index');
    Route::get('user/create', 'UsersController@create')->name('user.create');
    Route::post('user/store', 'UsersController@store')->name('user.store');
    Route::get('user/edit/{id}', 'UsersController@edit')->name('user.edit');
    Route::post('user/update/{id}', 'UsersController@update')->name('user.update');
    Route::post('user/destroy', 'UsersController@destroy')->name('user.destroy');


    Route::get('category', 'CategoriesController@index')->name('category.index');
    Route::post('category/store', 'CategoriesController@store')->name('category.store');
    Route::get('category/edit/{id}', 'CategoriesController@edit')->name('category.edit');
    Route::post('category/update/{id}', 'CategoriesController@update')->name('category.update');
    Route::post('category/delete', 'CategoriesController@destroy')->name('category.destroy');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
