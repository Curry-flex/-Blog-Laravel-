<?php

use App\Http\Controllers\TagController;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{id}', 'SinglePostController@details')->name('post.details');
Route::get('posts','SinglePostController@index')->name('post.index');
Route::get('category/{id}','SinglePostController@postByCategory')->name('category.post');
Route::get('tag/{id}','SinglePostController@postByTag')->name('tag.post');
Route::post('search', 'SearchController@search')->name('search');
Route::get('profile/{name}' ,'AuthorController@profile')->name('author.profile');


Auth::routes();

Route::group(['middleware'=>['auth']],function()
{
    Route::post('favourite/{post}/add' ,'FavouriteController@add')->name('post.favourite');
    Route::post('comment/{post}/add' ,'CommentController@store')->name('comment.store');
});

Route::post('subscriber','subscriberController@store')->name('subscriber.store');

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function (){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('tag','TagController');
    Route::resource('category','CategoryController');
    Route::resource('post','PostController');

    Route::get('settings','SettingController@index')->name('setting');
    Route::put('update-profile','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

    Route::put('/post/{id}/approve','PostController@approve')->name('post.approve');
    Route::get('pending/post','PostController@pending')->name('post.pending');
    Route::get('author/create','AuthorController@create')->name('author.create');
    Route::post('author/add','AuthorController@store')->name('author.store');
    
  

    Route::get('comments' ,'CommentController@index')->name('comment.index');
    Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

    Route::get('/subscriber','subscriberController@index')->name('subscriber.index');
    
    Route::get('/favourite','FavouriteController@index')->name('favourite.index');
    Route::delete('/subscriber/{id}','subscriberController@destroy')->name('subscriber.destroy');
    Route::get('authors','AuthorController@index')->name('author.index');
    Route::delete('author/{id}','AuthorController@delete')->name('author.delete');
    Route::get('add/authors','AuthorController@get')->name('get');

  
});

Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']], function (){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('post','PostController');

    Route::get('settings','SettingController@index')->name('setting');
    Route::put('update-profile','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');
    Route::get('/favourite','FavouriteController@favouriteindex')->name('favourite.indexx');

    Route::get('comments' ,'CommentController@index')->name('comment.index');
    Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

});



View::composer('layouts.frontend.include.footer',function($view){
    $category = App\Category::all();
    $view->with('categories',$category);
});




