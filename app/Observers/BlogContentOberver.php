<?php

namespace OrlandoLibardi\BlogCms\app\Obervers;

use OrlandoLibardi\BlogCms\app\ContentService;


class BlogContentOberver
{
    public function creating($content)
    {
        if($content->content)
        {   
            $contentService = new ContentService($content->blog_id, $content->content);
            $content->content = $contentService->saveContent();
        }
    }

    public function updating($content)
    {       
        if($content->content)
        { 
            $contentService = new ContentService($content->blog_id, $content->content);
            $content->content = $contentService->saveContent();
        }
    }


    public function deleting($content){
        $contentService = new ContentService($content->blog_id, $content->content);
        $contentService->destroy();        
    }

    
}