<?php

namespace OrlandoLibardi\BlogCms\app\Obervers;

use OrlandoLibardi\BlogCms\app\BlogCategory;

class BlogCategoryObserver{

    public function creating($category)
    {
        $category->alias = BlogCategory::categorieAlias(str_slug($category->name, '-'), 0); 
        $category->order_at = BlogCategory::maxOrder();
        $category->status = 1;
    }


}