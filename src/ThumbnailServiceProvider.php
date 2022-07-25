<?php

namespace Mro\Thumbnail;

use Illuminate\Support\ServiceProvider;

class ThumbnailServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind('thumbnail',function (){
            return new Thumbnail;
        });
    }
}
