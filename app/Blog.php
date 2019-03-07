<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;
use Log;

class Blog extends Model
{
    protected $fillable = [ 'title', 'alias', 'content', 'status', 'featured', 'type', 'publish_at', 'unpublished_at' ];
    /**
     * Categories
     */
    public function categories()
    {
       return $this->belongsToMany('OrlandoLibardi\BlogCms\app\BlogCategory', 'blog_has_categories',  'blog_id', 'category_id');                
    }
    /**
     * Photo
     */
    public function photo()
    {
        return $this->hasOne('OrlandoLibardi\BlogCms\app\BlogContent');
    }
    /**
     * Author
     */
    public function author()
    {
        return $this->hasOne('OrlandoLibardi\BlogCms\app\BlogHasAuthor')
                ->join('blog_authors',
                    function($join){
                        $join->on('blog_authors.id', '=', 'blog_has_authors.author_id');
                    });
    }
    /**
     * Meta 
     */
    public function meta(){
        return $this->hasOne('OrlandoLibardi\BlogCms\app\BlogMeta');
    }
    /**
     * Comments
     */
    public function comments()
    {
        return $this->belongsToMany('OrlandoLibardi\BlogCms\app\BlogComment', 'blog_has_comments',  'blog_id', 'comment_id');          
    }

    public function scopeComment($q)
    {
        return $q->comments()
                 ->whereHas('blog_comments', function($q){
                    $q->whereIn('status', 1);
                });
    }
    /**
     * Scope Search
     */
    public function scopeSearch($q, $terms)
    {
        return $q->active()
                 ->where(function($q) use ($terms) {
                    $q->orWhere('title', 'like',  "%{$terms}%")
                      ->orWhere('content', 'like',  "%{$terms}%");                   
                });
    }
    /**
     * Scope Related
     */
    public function scopeRelated($q, $id)
    {
        return $q->where('id', '!=', $id);
    }
    /**
     * Scope Featured
     */
    public function scopeFeatured($q)
    {
        return $q->where('featured', 1);
    }
    /**
     * Scope Publish
     */
    public function scopePublish($q){
        return $q->whereNull ('unpublished_at')
                 ->orWhere('unpublished_at', '>=', now()->format('Y-m-d'));
    }
    /**
     * Scope Active
     */
    public function scopeActive($q)
    {
        return $q->publish()
                 ->where([ ['status', '=', 1], ['publish_at', '<', now()->format('Y-m-d') ] ]);
                 
    }
    /**
     * Scope Categorie
     */
    public function scopeCategorie($q, $ids)
    {   
        return $q->active()
                ->whereHas('categories', function($q) use ($ids){
                    $q->whereIn('category_id', $ids);
                });
    }
    /**
     * Scope Alias
     */
    public function scopeAlias($q, $alias)
    {
        return $q->active()->where('alias', $alias);
    }
    /**
     *  Set unique Alias 
     */
    public static function alias($alias, $count=0)
    {
        $nalias = ($count > 0) ? $alias.'-'.$count : $alias;
        $blog = Blog::where('alias', $nalias)->get();        
        if(count($blog) > 0)
            return Blog::alias($alias, $count+1);

        return $nalias;
    }
    /**
     * Date updated_at Accessor
     */   
    public function getUpdatedAtAttribute($value)
    {
        if($value) return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    /**
     * Date publish_at Accessor
     */   
    public function getPublishAtAttribute($value)
    {
        if(substr_count($value, "/") > 0) return $value;
        if($value) return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
    /**
     * Date unpublished_at Accessor
     */   
    public function getUnpublishedAtAttribute($value)
    {
        if(substr_count($value, "/") > 0) return $value;
        if($value) return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }


    public function getImageLargerAttribute()
    {
        if(!$this->photo) return false;
        return str_replace('_small', '_larger', $this->photo->content);
    }

    public function getImageMeddiumAttribute()
    {
        if(!$this->photo) return false;
        return str_replace('_small', '_medium', $this->photo->content);
    }

    public function getImageSmallAttribute()
    {
        if(!$this->photo) return false;
        return $this->photo->content;
    }


    public function getSummaryAttribute()
    {
        $summary = substr( strip_tags( $this->content ), 0, 200);
        $summary .= (strlen( strip_tags( $this->content ) ) > 200) ? "..." : ""; 
        return $summary;
    }
   
}
