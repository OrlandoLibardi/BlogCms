<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;

class BlogHasCategory extends Model
{
    protected $fillable = [ 'blog_id', 'category_id' ];
    protected $table = "blog_has_categories";
    //protected $primaryKey = 'category_id';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    

}
