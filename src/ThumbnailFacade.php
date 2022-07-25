<?php

namespace Mro\Thumbnail;

use Illuminate\Support\Facades\Facade;

class ThumbnailFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'thumbnail';
    }

}
