<?php 

namespace Artdarek\Avatarer\Support\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Avatarer extends Facade {

    public static function getFacadeAccessor()
    {
        return 'Artdarek\Avatarer\Avatarer';
    }

} 