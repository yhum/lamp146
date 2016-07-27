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

Route::get('/', function () {
    return view('welcome');
});

//路由权限组
Route::group(['middleware'=>'login'],function () {
//后台首页
Route::get('/admin','admin\AdminController@index');
//用户模块
Route::controller('/admin/user','admin\UserController');   
//分类模块
Route::controller('/admin/sort','admin\SortController');
});
//文章模块
Route::controller('/admin/article','admin\ArticleController');

  