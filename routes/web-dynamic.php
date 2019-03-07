<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Estas rotas são administradas pelos eventos CreateRoutePage, UpdateRoutePage e DeleteRoutePage
| 
*/


Route::group(['middleware' => ['web']], function() {
    
      Route::get("blog/{alias?}", 'OrlandoLibardi\BlogCms\app\Http\Controllers\BlogShowController@index')
            ->where("alias", "([A-Za-z0-9(^+)\-\/]+)")
            ->name('page-blog');

      Route::post('blog-comment', 'OrlandoLibardi\BlogCms\app\Http\Controllers\CommentStoreController@store')
            ->name("blog-comment");
});
