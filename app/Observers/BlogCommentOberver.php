<?php

namespace OrlandoLibardi\BlogCms\app\Obervers;

class BlogCommentOberver
{
    public function creating($comment)
    {
       if(!$comment->status)
       {
            $comment->status = config('blog.comment_default_status');
       } 
    }
}
?>