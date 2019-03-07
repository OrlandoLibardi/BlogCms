<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;

class BlogHasComment extends Model
{
    protected $fillable = [ 'comment_id', 'blog_id' ];
    protected $table = "blog_has_comments";
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
