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

/* Frontend Routes */
Route::get('/',[
    'uses' => 'FrontendController@index',
    'as' => 'index',
]);

/* Post route */
Route::get('/post/{slug}',[
    'uses' => 'FrontendController@singlePost',
    'as' => 'post.single',
]);

/* Category route */
Route::get('/category/{id}',[
    'uses' => 'FrontendController@category',
    'as' => 'category.single'
]);

/* Tag route */
Route::get('/tag/{id}',[
    'uses' => 'FrontendController@tag',
    'as' => 'tag.single'
]);

/* Search route */

Route::get('/search',function(){
   $results = \App\Post::where('title','like','%'.request('query') .'%')->get();

   return view('front.result')
                              ->with('results', $results)
                              ->with('title', request('query'))
                              ->with('settings', \App\Setting::first())
                              ->with('categories', \App\Category::all()->take(5));
});

/* Authentication routes */
Auth::routes();


/* Admin routes */
Route::group(['prefix' => 'admin', 'middleware' => 'auth'],function(){

    /* Home route */
    Route::get('/home', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);

    /* Category routes */
    Route::get('/category/create',[
        'uses' => 'CategoriesController@create',
        'as' => 'category.create',
    ]);
    Route::get('/category/edit/{id}',[
        'uses' => 'CategoriesController@edit',
        'as' => 'category.edit',
    ]);
    Route::post('/category/update/{id}',[
        'uses' => 'CategoriesController@update',
        'as' => 'category.update',
    ]);

    Route::post('/category/store',[
        'uses' => 'CategoriesController@store',
        'as' => 'category.store',
    ]);
    Route::get('/categories',[
        'uses' => 'CategoriesController@index',
        'as' => 'category',
    ]);
    Route::get('/category/show/{id}',[
        'uses' => 'CategoriesController@show',
        'as' => 'category.show',
    ]);

    Route::get('/category/delete/{id}',[
        'uses' => 'CategoriesController@destroy',
        'as' => 'category.delete',
    ]);

    /* Post routes */
    Route::get('/posts',[
        'uses' => 'PostsController@index',
        'as' => 'post',
    ]);
    Route::get('/post/create',[
       'uses' => 'PostsController@create',
       'as' => 'post.create',
    ]);
    Route::post('/post/store',[
        'uses' => 'PostsController@store',
        'as' => 'post.store',
    ]);
    Route::get('/post/edit/{id}',[
        'uses' => 'PostsController@edit',
        'as' => 'post.edit'
    ]);
    Route::post('/post/update/{id}',[
        'uses' => 'PostsController@update',
        'as' => 'post.update'
    ]);
    Route::get('/post/show/{id}',[
        'uses' => 'PostsController@show',
        'as' => 'post.show'
    ]);
    // soft delete
    Route::get('/post/delete/{id}',[
        'uses' => 'PostsController@destroy',
        'as' => 'post.delete'
    ]);
    Route::get('/post/trash',[
        'uses' => 'PostsController@trash',
        'as' => 'post.trash'
    ]);
    // delete permanently
    Route::get('/post/kill/{id}',[
        'uses' => 'PostsController@kill',
        'as' => 'post.kill'
    ]);
    // restore
    Route::get('/post/restore/{id}',[
        'uses' => 'PostsController@restore',
        'as' => 'post.restore'
    ]);

    /* Tag routes */
    Route::get('/tags',[
        'uses' => 'TagsController@index',
        'as' => 'tag',
    ]);
    Route::get('/tag/create',[
        'uses' => 'TagsController@create',
        'as' => 'tag.create',
    ]);
    Route::post('/tag/store',[
        'uses' => 'TagsController@store',
        'as' => 'tag.store',
    ]);
    Route::post('/tag/update/{id}',[
        'uses' => 'TagsController@update',
        'as' => 'tag.update',
    ]);
    Route::get('/tag/edit/{id}',[
        'uses' => 'TagsController@edit',
        'as' => 'tag.edit',
    ]);
    Route::get('/tag/delete/{id}',[
        'uses' => 'TagsController@destroy',
        'as' => 'tag.delete',
    ]);

    /* User routes */
    Route::get('/users',[
        'uses' => 'UsersController@index',
        'as' => 'user'
    ]);

    Route::get('/user/create',[
        'uses' => 'UsersController@create',
        'as' => 'user.create'
    ]);
    Route::post('/user/store',[
        'uses' => 'UsersController@store',
        'as' => 'user.store'
    ]);

    Route::get('/user/admin/{id}',[
        'uses' => 'UsersController@admin',
        'as' => 'user.admin'
    ]);

    Route::get('/user/notAdmin/{id}',[
        'uses' => 'UsersController@notAdmin',
        'as' => 'user.notAdmin'
    ]);

    Route::get('/user/delete/{id}',[
        'uses' => 'UsersController@destroy',
        'as' => 'user.delete'
    ]);

    /* User profile route */
    Route::get('/user/profile',[
        'uses' => 'ProfilesController@index',
        'as' => 'user.profile'
    ]);

    Route::post('/user/profile/update',[
        'uses' => 'ProfilesController@update',
        'as' => 'user.profile.update'
    ]);

    /* setting routes */
    Route::get('/settings',[
        'uses' => 'SettingsController@index',
        'as' => 'settings',
    ]);
    Route::post('/settings/update',[
        'uses' => 'SettingsController@update',
        'as' => 'settings.update',
    ]);


});

//Route::resource('category', 'CategoriesController');