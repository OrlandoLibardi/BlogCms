<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [ 'parent_id', 'name', 'alias', 'description', 'status', 'order_at' ];

    public function childs(){
        return $this->hasMany('OrlandoLibardi\BlogCms\app\BlogCategory', 'parent_id', 'id');
    }

    public static function Categories($parent_id=0)
    {
        return BlogCategory::where('parent_id', '=', $parent_id)
              ->orderBy('name', 'ASC')
              ->get();
    }

    public static function categorieAlias($alias, $count=0)
    {
        $nalias = ($count > 0) ? $alias.'-'.$count : $alias;
        $blog = BlogCategory::where('alias', $nalias)->get();        
        if(count($blog) > 0)
            return BlogCategory::categorieAlias($alias, $count+1);

        return $nalias;
    }

    public static function maxOrder(){
        $q = BlogCategory::orderBy('order_at', 'DESC')->first();
        if($q)
            return $q->order_at + 1;
        
        return 1;    
    }

    public function blogs()
    {
        return $this->belongsToMany('OrlandoLibardi\BlogCms\app\Blog', 'blog_has_categories',  'category_id', 'blog_id');  
    }
    
}
