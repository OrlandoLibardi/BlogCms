<?php

namespace OrlandoLibardi\BlogCms\app\Obervers;

use OrlandoLibardi\BlogCms\app\Blog;
use Log;

class BlogObserver{

    public function creating($blog)
    {
        $blog->alias = Blog::alias(str_slug($blog->title, '-'), 0); 
        $blog->status = 1;
        $blog->featured = 0;
        $blog->type = 1;     
        
        if(!empty($blog->publish_at))
        {
            if(substr_count($blog->publish_at, "/") > 0)
            {                
                $d = explode("/", $blog->publish_at);
                $blog->publish_at = $d[2] . '-' . $d[1] . '-' . $d[0];
            } 

        }else{

            $blog->publish_at = \Carbon\Carbon::now();
        }


        if(!empty($blog->unpublished_at))
        {
            if(substr_count($blog->unpublished_at, "/") > 0)
            {
                $d = explode("/", $blog->unpublished_at);
                $blog->unpublished_at = $d[2] . '-' . $d[1] . '-' . $d[0];
            }
        }

        
    }


    public function updating($blog)
    {
        
        if(!empty($blog->publish_at))
        {
            if(substr_count($blog->publish_at, "/") > 0)
            {              
                $d = explode("/", $blog->publish_at);
                $blog->publish_at = $d[2] . '-' . $d[1] . '-' . $d[0];
            } 
            
        }else{

            $blog->publish_at = \Carbon\Carbon::now();  
        }

        if(!empty($blog->unpublished_at))
        {
            if(substr_count($blog->unpublished_at, "/") > 0)
            {
                $d = explode("/", $blog->unpublished_at);
                $blog->unpublished_at = $d[2] . '-' . $d[1] . '-' . $d[0];
            }
        }

    }



}