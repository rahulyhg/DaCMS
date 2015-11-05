<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// dacms.co or dacms.dev
Route::group(array('domain' => env('APP_DOMAIN')), function()
{

// HomeController
Route::get('/', 'HomeController@getIndex');
Route::get('contact', 'HomeController@getContact');
Route::post('contact', 'HomeController@postContact');
Route::get('login', 'HomeController@getLogin');
Route::post('login', 'HomeController@postLogin');
Route::get('logout', 'HomeController@getLogout');
Route::get('feed', 'HomeController@getFeed');
Route::get('feed/en', 'HomeController@getFeeden');
Route::get('feed/projects', 'HomeController@getFeedprojects');
Route::get('feed/projects/en', 'HomeController@getFeedprojectsen');
Route::get('sitemap', 'HomeController@getSitemap');

// PageController
Route::get('about', 'PageController@getAbout');
Route::get('privacy', 'PageController@getPrivacy');
Route::get('page/add', 'PageController@getCreate');
Route::post('page/add', 'PageController@postCreate');
Route::get('page/edit/{id}', 'PageController@getEdit');
Route::post('page/edit/{id}', 'PageController@postEdit');
Route::get('page/del/{id}', 'PageController@getDelete');
Route::post('page/del/{id}', 'PageController@postDelete');

// PostController
Route::get('blog', 'PostController@getIndex');
Route::get('blog/add', 'PostController@getCreate');
Route::post('blog/add', 'PostController@postCreate');
Route::get('blog/edit/{id}', 'PostController@getEdit');
Route::post('blog/edit/{id}', 'PostController@postEdit');
Route::get('blog/del/{id}', 'PostController@getDelete');
Route::post('blog/del/{id}', 'PostController@postDelete');
Route::get('blog/{slug}', 'PostController@getView');

// CategoryController
Route::get('Categorys', 'CategoryController@getIndex');
Route::get('Categorys/add', 'CategoryController@getCreate');
Route::post('Categorys/add', 'CategoryController@postCreate');
Route::get('Categorys/edit/{id}', 'CategoryController@getEdit');
Route::post('Categorys/edit/{id}', 'CategoryController@postEdit');
Route::get('Categorys/del/{id}', 'CategoryController@getDelete');
Route::post('Categorys/del/{id}', 'CategoryController@postDelete');
Route::get('Categorys/{slug}', 'CategoryController@getView');

// TagController
Route::get('tag', 'TagController@getIndex');
Route::get('tag/{slug}', 'TagController@getView');

// AdminController
Route::get('admin', 'AdminController@getIndex');
Route::get('admin/sync', 'AdminController@getSync');
Route::get('admin/update', 'AdminController@getUpdate');

});

// cdn.dacms.dev
Route::group(array('domain' => 'cdn.'.env('APP_DOMAIN')), function()
{
    Route::get('/', 'CDN\CDNController@getIndex');
});