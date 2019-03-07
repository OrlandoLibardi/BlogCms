<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;

class BlogMeta extends Model
{
    protected $fillable = [ 'blog_id', 'title', 'description' ];
    public $primaryKey = 'blog_id';
    public $incrementing = false;
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
