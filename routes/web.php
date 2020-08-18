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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function(){
	return view('welcome');
});
Route::get('/hy', function(){
	return "Happy Birthday";
});
Route::get('/hi/{id}', function($id){
	return" this is hi from id ".$id;
});
Route::get('/hi/{name}', function($name){
	return "this is hi from ".$name; 
});
Route::get('/hi/{name}/{id}', function($name, $id){
	return "this is hi from ".$name." and id is ".$id;
});
Route::get('/admin/post/example',array('as' =>'admin.home',function(){
	$url=route('admin.home');
	return"this url is ".$url;
}));
#use of controllers in route. Learning well 
Route::get('/post','PostController@index');
Route::get('/post/{id}', 'PostController@show'); 
# use of resource method  to get routes of controller
Route::resource('/post','PostController');