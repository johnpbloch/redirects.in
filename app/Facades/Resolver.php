<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Resolver extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'resolver';
    }

}
