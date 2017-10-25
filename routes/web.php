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
    return view('welcome');
});

Auth::routes();

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('categories', 'CategoriesController');

//Route::resource('objects', 'ObjectController');

Route::post('/objects/category',[
    'uses' => 'ObjectController@choseCategory',
    'as' => 'objects.category'
]);

Route::get('/objects/step1/{id?}', [
    'uses' => 'ObjectController@step1',
    'as' => 'objects.step1'
]);

Route::post('/objects/step1',[
    'uses' => 'ObjectController@postStep1',
    'as' => 'objects.post.step1'
]);

Route::get('/objects/category/change/{type}',[
    'uses' => 'ObjectController@changeCategory',
    'as' => 'objects.category.change'
]);

Route::get('/objects/step2/{id?}', [
    'uses' => 'ObjectController@step2',
    'as' => 'objects.step2'
]);

Route::post('/objects/step2/{id?}',[
    'uses' => 'ObjectController@postStep2',
    'as' => 'objects.post.step2'
]);