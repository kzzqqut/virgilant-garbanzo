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

Auth::routes();

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('categories', 'CategoriesController');

//Route::resource('objects', 'ObjectController');

//index
Route::get('/{cat?}', [
    'uses' => 'PagesController@index',
    'as' => 'index'
]);

Route::get('/objects',[
    'uses' => 'ObjectController@index',
    'as' => 'objects.index'
]);

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

Route::delete('/objects/{object}',[
    'uses' => 'ObjectController@destroy',
    'as' => 'objects.destroy'
]);