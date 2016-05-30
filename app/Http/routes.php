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

// add CORS headers
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => config('admin.prefix', 'admin'), 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => config('admin.filter.auth')], function () {
        
        Route::group(['middleware' => config('admin.filter.OnlyAdmin')], function () {

            // upload images
            Route::post('categoriestips/uploadImage', 'AdminCategoriesTipsController@uploadImage');

            Route::resource('categoriestips', 'AdminCategoriesTipsController');
            Route::resource('comments', 'AdminCommentsController');
            Route::resource('push_type', 'AdminPushTypeController');
            Route::resource('devices', 'AdminDevicesController');
        });

            Route::post('tips/uploadImage', 'AdminTipsController@uploadImage');
            Route::post('posts/uploadImage', 'AdminPostsController@uploadImage');

            Route::resource('posts', 'AdminPostsController');
            Route::resource('tips', 'AdminTipsController');
            Route::resource('challenges', 'AdminChallengesController');
        

	});

});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' =>   'api/v1'], function () {

    Route::group(['middleware' => 'api'], function () {

        // devices services
        Route::resource('device', 'Api\v1\DeviceController',
                    ['only' => [ 'store' ]]);

        // categories services
        Route::resource('category', 'Api\v1\CategoriesTipsController',
                    ['only' => [ 'index' ]]);

        Route::resource('tipsByCategory', 'Api\v1\CategoriesTipsController',
                    ['only' => [ 'show' ]]);

        // tips services
        Route::resource('tips', 'Api\v1\TipsController',
                    ['only' => [ 'index', 'show' ]]);

        // comments services
        Route::resource('comments', 'Api\v1\CommentsController',
                    ['only' => [ 'index' ]]); 

        /***************************************************
    	// Add suplementary resources for challenges.
        // you should define those routes before your call to Route::resource https://laravel.com/docs/5.1/controllers#restful-supplementing-resource-controllers
        /***************************************************/
        Route::post('challenge/comment', [
        	'as' => 'api.v1.challenge.comment', 'uses' => 'Api\v1\ChallengesController@add_comment'
    	]);

    	Route::post('challenge/like', [
        	'as' => 'api.v1.challenge.like', 'uses' => 'Api\v1\ChallengesController@like'
    	]);

        Route::resource('challenge', 'Api\v1\ChallengesController',
                    ['only' => [ 'index', 'show' ]]);


        /***************************************************
    	// Add suplementary resources for feed.
        // you should define those routes before your call to Route::resource https://laravel.com/docs/5.1/controllers#restful-supplementing-resource-controllers
        /***************************************************/
        Route::post('feed/comment', [
        	'as' => 'api.v1.feed.comment', 'uses' => 'Api\v1\FeedsController@add_comment'
    	]);
    	
    	Route::post('feed/like', [
        	'as' => 'api.v1.feed.like', 'uses' => 'Api\v1\FeedsController@like'
    	]);

        Route::resource('feed', 'Api\v1\FeedsController',
                    ['only' => [ 'index', 'store' ]]);

        /***************************************************
        // Add suplementary resources for post.
        // you should define those routes before your call to Route::resource https://laravel.com/docs/5.1/controllers#restful-supplementing-resource-controllers
        /***************************************************/
        Route::post('post/comment', [
            'as' => 'api.v1.post.comment', 'uses' => 'Api\v1\PostsController@add_comment'
        ]);

        Route::post('post/like', [
            'as' => 'api.v1.post.like', 'uses' => 'Api\v1\PostsController@like'
        ]);

        Route::resource('post', 'Api\v1\PostsController',
                    ['only' => [ 'index', 'show' ]]);

  
    });


});
