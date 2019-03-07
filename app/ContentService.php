<?php

namespace OrlandoLibardi\BlogCms\app;

use OrlandoLibardi\FilesCms\app\Repositories\ImageRepository;
use OrlandoLibardi\BlogCms\app\Blog;

class ContentService extends ImageRepository{
 

    public $img_path;
    public $larger_size;
    public $medium_size;
    public $small_size;
    public $final_path;
    public $alias;


    public function __construct( $blog_id, $content )
    {
        $this->img_path  = config('blog.img_path');
        $this->larger_size = config('blog.img_larger_size');
        $this->medium_size = config('blog.img_medium_size');
        $this->small_size = config('blog.img_small_size');
        $this->blog_id = $blog_id;
        $this->final_path = $this->img_path . $this->blog_id . "/";
        $this->image_url  = config('blog.img_url') . $this->blog_id . "/";
        $this->alias =  Blog::find($this->blog_id)->alias;
        $this->content = $this->chacheUrlforPath($content);
    }


    public function chacheUrlforPath($value){
        return str_replace('/storage/', 'public/', $value);
    }

    public function saveContent()
    {
        $this->saveContentImage($this->larger_size);        
        $this->saveContentImage($this->medium_size);
        return $this->saveContentImage($this->small_size);        
    }

    public function saveContentImage($size){

        $photo = $this->saveImage($this->final_path, $this->content, $size);
        $photo_name = $this->alias . $size['type'];
        $photo_name = $this->rename($this->final_path, $photo, $photo_name);

        return  $this->image_url . $photo_name;

    }

    public function removePatch(){
        $temp = explode("/", $this->content);
        return end($temp);
    }

    public function destroy(){

        $file   = $this->removePatch();
        $larger = str_replace("_small", "_larger", $file);
        $medium = str_replace("_small", "_medium", $file);
        $small  = $file;

        $this->delete($this->final_path, $file);
        $this->delete($this->final_path, $medium);
        $this->delete($this->final_path, $larger);
        
    }
    

}