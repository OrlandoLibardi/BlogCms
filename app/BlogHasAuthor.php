<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;

class BlogHasAuthor extends Model
{
    protected $fillable = [ 'blog_id', 'author_id' ];
    public $primaryKey = 'blog_id';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
