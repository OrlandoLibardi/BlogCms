<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;
use OrlandoLibardi\BlogCms\app\ContentService;
use Log;

class BlogContent extends Model
{
    protected $fillable = [ 'blog_id', 'content' ];
    public $primaryKey = 'blog_id';
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function blog(){
        return $this->belongsTo('OrlandoLibardi\BlogCms\app\Blog');
    }

    


}
