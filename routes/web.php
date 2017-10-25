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

Route::get('/objects/manage/{id?}', [
    'uses' => 'ObjectController@manage',
    'as' => 'objects.manage'
]);

Route::post('/objects/manage/{id?}',[
    'uses' => 'ObjectController@postManage',
    'as' => 'objects.post.manage'
]);

Route::post('/objects/category/save',[
    'uses' => 'ObjectController@postCategory',
    'as' => 'objects.post.category'
]);

Route::get('/objects/category/change/{type}',[
    'uses' => 'ObjectController@changeCategory',
    'as' => 'objects.category.change'
]);

Route::get('/objects/photo/remove/{id}',[
    'uses' => 'ObjectController@photoRemove',
    'as' => 'objects.photo.remove'
]);