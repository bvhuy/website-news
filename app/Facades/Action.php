<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Action extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\Action::class;
    }
}
