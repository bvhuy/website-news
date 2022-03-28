<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AdminMenu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\AdminMenu::class;
    }
}
