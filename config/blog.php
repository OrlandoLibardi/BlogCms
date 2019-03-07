<?php
return [
    /*
    |--------------------------------------------------------------------------
    | CONFIGURAÇÃO DE IMAGENS PARA AUTORES
    |--------------------------------------------------------------------------
    */
    'author_path' => 'public/blog/authors/',
    'author_url' =>  '/storage/blog/authors/',
    'author_image_width' => '120',
    'author_image_height' => '120',
    /*
    |--------------------------------------------------------------------------
    | CONFIGURAÇÃO DE IMAGENS PARA POSTAGENS
    |--------------------------------------------------------------------------
    */
    'img_path' => 'public/blog/',
    'img_url'  => '/storage/blog/',
    'img_larger_size' => ['width' => 1920, 'height' => 1080, 'type' => '_larger'],
    'img_medium_size' => ['width' => 794, 'height' => 529, 'type' => '_medium'],
    'img_small_size' => ['width' => 450, 'height' => 300, 'type' => '_small'],
    /*
    |--------------------------------------------------------------------------
    | CONFIGURAÇÃO
    |--------------------------------------------------------------------------
    */
    'offset' => 0, 
    'limit' => 4, 
    'paginate' => false, 
    'categories' => false,
    'exclude' => false, 
    'alias' => false,
    'comment_default_status' => 0,
    'template_summary' => 'website.blog.modules.summary',
    'template_featured' => 'website.blog.modules.featured',
    'template_related' => 'website.blog.modules.related',
    'template_details' => 'website.blog.modules.details',
    'template_meta_tags' => 'website.blog.modules.meta',
    'template_author' => 'website.blog.modules.author',
    'template_category' => 'website.blog.modules.category',
    'template_comment_form' => 'website.blog.modules.comment_form',
    'template_comment_list' => 'website.blog.modules.comment_list',
    'page_details' => 'website.blog.detail',
    'page_default' => 'website.blog.default',   
    'page_search' => 'website.blog.search', 
    'page_categorie' => 'website.blog.categorie',    
];
