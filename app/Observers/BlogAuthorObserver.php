<?php

namespace OrlandoLibardi\BlogCms\app\Obervers;

use OrlandoLibardi\BlogCms\app\BlogCategory;
use OrlandoLibardi\FilesCms\app\Repositories\ImageRepository;


class BlogAuthorObserver{

    public function creating($author)
    {
        if($author->photo){
            $image = new ImageRepository;
            $size  = ['width' => config('blog.author_image_width'), 'height' => config('blog.author_image_height')];
            $path  = config('blog.author_path');
            $photo = $image->saveImage($path, $author->photo, $size);
            $name  = str_slug( $author->name );
            $author->photo = $image->rename($path, $photo, $name);
        }
    }


    public function updating($author)
    {
        if($author->photo){
            $image = new ImageRepository;
            $size  = ['width' => config('blog.author_image_width'), 'height' => config('blog.author_image_height')];
            $path  = config('blog.author_path');
            $photo = $image->saveImage($path, $author->photo, $size);
            $name  = str_slug( $author->name );
            $author->photo = $image->rename($path, $photo, $name);
        }
    }

    public function deleting($author)
    {
        if($author->photo){
            $image = new ImageRepository;
            $image->delete(config('blog.author_path'), $author->photo);
        }
    }



}