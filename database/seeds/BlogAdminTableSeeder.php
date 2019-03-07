<?php

use Illuminate\Database\Seeder;
use OrlandoLibardi\PageCms\app\Page;
use OrlandoLibardi\OlCms\AdminCms\app\Admin;

class BlogAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
       
       $blog =  Admin::create([
                    'name' => 'Blog',
                    'route' => '',
                    'icon' => 'fa fa-file-text-o',
                    'parent_id' => 0,
                    'minimun_can' => 'list',
                    'order_at' => 3
                ]);


       /* Blog list */
       Admin::create([
        'name' => 'Postagens',
        'route' => 'blog.index',
        'icon' => '',
        'parent_id' => $blog->id,
        'minimun_can' => 'list',
        'order_at' => 1
       ]);
       /* Blog Categories list */
       Admin::create([
        'name' => 'Categorias',
        'route' => 'blog-categories.index',
        'icon' => '',
        'parent_id' => $blog->id,
        'minimun_can' => 'list',
        'order_at' => 2
       ]);
       /* Blog Categories list */
       Admin::create([
        'name' => 'Autores',
        'route' => 'blog-authors.index',
        'icon' => '',
        'parent_id' => $blog->id,
        'minimun_can' => 'list',
        'order_at' => 3
       ]);
       /* Blog Comentários list */
       Admin::create([
        'name' => 'Comentários',
        'route' => 'blog-comments.index',
        'icon' => '',
        'parent_id' => $blog->id,
        'minimun_can' => 'list',
        'order_at' => 4
       ]);
                

    }
}
