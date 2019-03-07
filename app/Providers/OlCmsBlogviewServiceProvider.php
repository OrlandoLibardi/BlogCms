<?php

namespace OrlandoLibardi\BlogCms\app\Providers;


class OlCmsBlogviewServiceProvider extends ServiceProvider{
    
    /**
     * Register the service provider.
     */
    public function register()
    {               
        $this->registerOlCmsBlogBuilder();
        $this->app->alias('OlCmsBlog', OlCmsBlogBuilder::class);        
    }

    /**
     * Register the OlCmsBlog builder instance.
     */
    protected function registerOlCmsBlogBuilder()
    {
        $this->app->singleton('OlCmsBlog', function ($app) {
            return new OlCmsBlogBuilder();
        });
    }    

    /**
     * Get the services provided by the provider.
     */
    public function provides()
    {
        return ['OlCmsBlog', OlCmsBlogBuilder::class];
    }
}

