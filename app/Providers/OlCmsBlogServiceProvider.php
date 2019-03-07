<?php
namespace OrlandoLibardi\BlogCms\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

use OrlandoLibardi\BlogCms\app\BlogCategory;
use OrlandoLibardi\BlogCms\app\Obervers\BlogCategoryObserver;
use OrlandoLibardi\BlogCms\app\BlogAuthor;
use OrlandoLibardi\BlogCms\app\Obervers\BlogAuthorObserver;
use OrlandoLibardi\BlogCms\app\Blog;
use OrlandoLibardi\BlogCms\app\Obervers\BlogObserver;
use OrlandoLibardi\BlogCms\app\BlogContent;
use OrlandoLibardi\BlogCms\app\Obervers\BlogContentOberver;
use OrlandoLibardi\BlogCms\app\BlogComment;
use OrlandoLibardi\BlogCms\app\Obervers\BlogCommentOberver;


class OlCmsBlogServiceProvider extends ServiceProvider{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Rotas para controllador Blog
         */
        Route::namespace('OrlandoLibardi\BlogCms\app\Http\Controllers')
               ->middleware(['web', 'auth'])
               ->prefix('admin')
               ->group(__DIR__. '/../../routes/web.php');

        /**
         * Rotas publicas 
         */
        $this->loadRoutesFrom(__DIR__. '/../../routes/web-dynamic.php');
        /**
         * Publicar os arquivos 
         */
        $this->publishes( [
            __DIR__.'/../../database/migrations/' => database_path('migrations/'),
            __DIR__.'/../../resources/views/admin/' => resource_path('views/admin/'),
            __DIR__.'/../../resources/views/website/' => resource_path('views/website/'), 
            __DIR__.'/../../database/seeds/' => database_path('seeds'),
            __DIR__.'/../../config/blog.php' => config_path('blog.php'),
        ],'config');
        
        /**
         * Observer Blog
         */
        Blog::observe(BlogObserver::class);
        /**
         * Observer Blog Category
         */
        BlogCategory::observe(BlogCategoryObserver::class);
        /**
        * Observer Blog Author
        */
        BlogAuthor::observe(BlogAuthorObserver::class);
        /**
         * Observer Blog Content
         */
        BlogContent::observe(BlogContentOberver::class);
        /**
         * Observer Blog Comment
         */
        BlogComment::observe(BlogCommentOberver::class);
        
    }
}