<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// dacms.co or dacms.dev
Route::group( [ 'domain' => Config::get('app.domain') ], function()
{

	// AdminController
	Route::group( [ 'middleware' => ['auth', 'moderator'] ], function ()
	{
		Route::get('admin', 'AdminController@getIndex');
	});

	Route::group( [ 'middleware' => ['auth', 'admin'] ], function ()
	{
		Route::get('admin/update', 'AdminController@getUpdate');
		Route::get('admin/disqus2db', 'AdminController@getDisqus2db');
	});


	// HomeController
	Route::get('contact', 'HomeController@getContact');
	Route::post('contact', 'HomeController@postContact');
	Route::get('feed', 'HomeController@getFeed');
	Route::get('sitemap', 'HomeController@getSitemap');


	// UserCotroller
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
	Route::get('logout', 'UserController@getLogout');

	Route::group( [ 'middleware' => [ 'auth', 'moderator' ] ], function ()
	{
		Route::get('user/add', 'UserController@getCreate');
		Route::post('user/add', 'UserController@postCreate');
		Route::get('user/edit/{id}', 'UserController@getEdit');
		Route::post('user/edit/{id}', 'UserController@postEdit');
		Route::get('user/del/{id}', 'UserController@getDelete');
		Route::post('user/del/{id}', 'UserController@postDelete');
	});

	Route::group( [ 'middleware' => ['auth'] ], function ()
	{
		Route::get('dashboard', 'UserController@getDashboard');
	});

	Route::get('user/{id}', 'UserController@getView');


	// PostController
	Route::group( [ 'middleware' => [ 'auth', 'editor' ] ], function ()
	{
		Route::get('blog/add', 'PostController@getCreate');
		Route::post('blog/add', 'PostController@postCreate');
		Route::get('blog/edit/{id}', 'PostController@getEdit');
		Route::post('blog/edit/{id}', 'PostController@postEdit');
		Route::get('blog/del/{id}', 'PostController@getDelete');
		Route::post('blog/del/{id}', 'PostController@postDelete');
	});

	Route::get('blog', 'PostController@getIndex');
	Route::get('blog/{slug}', 'PostController@getView');
	Route::any('search', 'PostController@Search');


	// CategoryController
	Route::group( [ 'middleware' => [ 'auth', 'editor' ] ], function ()
	{
		Route::get('category/add', 'CategoryController@getCreate');
		Route::post('category/add', 'CategoryController@postCreate');
		Route::get('category/edit/{id}', 'CategoryController@getEdit');
		Route::post('category/edit/{id}', 'CategoryController@postEdit');
		Route::get('category/del/{id}', 'CategoryController@getDelete');
		Route::post('category/del/{id}', 'CategoryController@postDelete');
	});

	Route::get('categories', 'CategoryController@getIndex');
	Route::get('category/{slug}', 'CategoryController@getView');


	// TagController
	Route::group( [ 'middleware' => [ 'auth', 'editor' ] ], function ()
	{
		Route::get('tag/add', 'TagController@getCreate');
		Route::post('tag/add', 'TagController@postCreate');
		Route::get('tag/edit/{id}', 'TagController@getEdit');
		Route::post('tag/edit/{id}', 'TagController@postEdit');
		Route::get('tag/del/{id}', 'TagController@getDelete');
		Route::post('tag/del/{id}', 'TagController@postDelete');
	});

	Route::get('tags', 'TagController@getIndex');
	Route::get('tag/{slug}', 'TagController@getView');


	// PageController
	Route::group( [ 'middleware' => [ 'auth', 'editor' ] ], function ()
	{
		Route::get('page/add', 'PageController@getCreate');
		Route::post('page/add', 'PageController@postCreate');
		Route::get('page/edit/{id}', 'PageController@getEdit');
		Route::post('page/edit/{id}', 'PageController@postEdit');
		Route::get('page/del/{id}', 'PageController@getDelete');
		Route::post('page/del/{id}', 'PageController@postDelete');
	});

	Route::get('/', 'PageController@getView');
	Route::get('/{slug}', 'PageController@getView');
	Route::get('/pages', 'PageController@getIndex');

});