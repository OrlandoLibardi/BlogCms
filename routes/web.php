<?php

/*
* Categorias
*/
Route::resource('blog-categories', 'BlogCategoryController');
/**
 *  Authors
 */
Route::resource('blog-authors', 'BlogAuthorController');
/**
 * Imagens
 */
Route::resource('blog-images', 'BlogImageController');
/**
 * Comments
 */
Route::patch('blog-comment-status/{id}', 'BlogCommentController@status')->name('blog-comment-status');
Route::resource('blog-comments', 'BlogCommentController');
/**
 * Blog
 */
Route::patch('blog-status/{id}', 'BlogController@changeStatusOrFeatured')->name('blog-status');

Route::resource('blog', 'BlogController');
