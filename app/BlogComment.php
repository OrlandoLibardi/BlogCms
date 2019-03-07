<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [ 'parent_id', 'name', 'email', 'title', 'comment', 'status' ];

    /**
     * 
     */
    public function reply()
    {
        return $this->hasMany('OrlandoLibardi\BlogCms\app\BlogComment', 'parent_id', 'id');
    }

    public function blog()
    {
        return $this->belongsToMany('OrlandoLibardi\BlogCms\app\Blog', 'blog_has_comments', 'comment_id', 'blog_id');
    }

    public function scopeComments($q, $blog_id)
    {
        return $q->whereHas('blog', function($q) use ($blog_id){
                    $q->where('blog_id', $blog_id);
                });
    }

    public function scopeApproved($q)
    {
        return $q->where('status', 1);
    }

    /**
     * Date created_at Accessor
     */   
    public function getCreatedAtAttribute($value)
    {
        if($value) return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
      


}
