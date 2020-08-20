<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
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
Route::get('/contact', 'PostController@contact'); 
# use of resource method  to get routes of controller
Route::resource('/post','PostController');
#Route::get('/posts/{id}',"PostController@show_post");
Route::get('/posts/{id}/{name}/{password}',"PostController@show_post");
#database raw sql queries
Route::get('/insert', function(){
	DB::insert('insert into posts(title, content )values(?,?)',['Python with flask','this is awesome to build web with python using Flask']);
});
#database access using db command
Route::get('/get',function(){
	$result=DB::select('select * from posts where id = ?',[1]);
	#return $result;
	#or
	#foreach($result as $post){
	#	return $post -> title;

	#}
	#or
	return var_dump($result);
});
#update data from database
Route::get('/update',function(){
	$updated = DB::update('update posts set title="update title" where id=?',[1]);
	return $updated;
});

#deleting from database raw query
Route::get('/delete',function(){
	$deleted = DB::delete('delete from posts where id=?',[1]);
	return $deleted; 

}); 
#eloquent ORM
#db handling using class model
#to do this we must import post model so we use
#use App\Post
Route::get('/find',function(){
	$posts= Post::all(); 
	foreach($posts as $post){
		
		echo $post -> title. "<br>";
	}
});
Route::get('/finds',function(){
	$post=Post::find(3);
	return $post -> title;
});


Route::get('/findwhere', function(){
	$posts= Post::where('id', 2) -> orderBy('id','desc')->take(1) -> get();
	return $posts;
});
Route::get('/findmore',function(){
	$post=Post::findOrFail(2);
	return $post;
});
Route::get('/basicinsert',function(){
	$post= new Post;
	$post-> title="new title";
	$post -> content="have happy learning.enjoy it";
	$post-> save();

});
Route::get('/basicupdate', function(){
	$post= Post::findOrFail(4);
	$post-> title="hello";
	$post -> content =" hey i am having fun here";
	$post -> save();
});
#creation of data and mass assignment

Route::get('/create',function(){
	Post :: create(['title' => "PHP", 'content' => "wow i am learning it well. Thank you all for helping me on PHP"]);


});
#new way of deleting file
Route::get('/updates',function(){
	Post :: where('id', 2)-> where('is_comment', 'yes')-> update(['title'=>"we are having fun", 'content'=>"this is awewsome part of my lifee"]);
});

#new way of deleting data

Route::get('/del',function(){
	$post=Post::find(2);
	$post->delete();
});
Route::get('/dels',function(){
	Post :: destroy(3);
});
Route::get('/dele',function(){
	Post :: destroy([4,5]);
	#Post ::where('is_comment', "yes")->delete();
});

#softdeleting or temporary delete process
Route::get('/softdelete', function(){
 	Post ::find(4)->delete();
});
Route::get('/resoftdelete', function(){
 	#$post= Post ::find(1);
 	#return $post;
 	#OR
 	#$posts=Post :: withTrashed()->where('id',1)->get();
 	#return $posts;
 	#OR
 	$post= Post :: onlyTrashed()->where('is_comment',"yes")->get();
 	return $post;


}); 

#restore deleted one
Route ::get('/restore', function(){
	Post :: withTrashed()->where('is_comment',"yes")->restore();
});

#delete data permanently/forcedelete
Route::get('/forcedelete',function(){
	Post :: onlyTrashed()->where('is_comment',"yes")->forceDelete();
});

#db relation related to post and table
#ELOQUENT Rerlationship
//for following purpose we have to import user model using use 'App\Users'

Route::get('/user/{id}/post', function($id){
	#$post=User::find($id)->post;
	#return $post;
	//or
	return User :: find($id)->post->title;
});
#inverse relation

Route::get('/post/{id}/user', function($id){
	return Post :: find($id)->user->name;
});

#one to many  relaatiion in db
#models have to be imported  before using db
Route :: get('/posts',function(){
	$user = User :: find(1);
	#return $user;
	foreach($user -> posts as $post){
		echo $post->title . "<br>";
	}
});


#many to many relations in DB