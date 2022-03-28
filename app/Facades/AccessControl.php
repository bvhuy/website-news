<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AccessControl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\AccessControl::class;
    }
}
