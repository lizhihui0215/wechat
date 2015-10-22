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

Route::match(['get','post'],'/', "WeChatAuthController@index");

Route::get('/register',function(){
  return view('users.register');
});

Route::get('/profile',function (){
  return view('users.profile');
});

Route::get('/index',function(){
  return view('welcome');
});
