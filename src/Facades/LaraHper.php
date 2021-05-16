<?php
namespace Mrba\LaraHper\Facades;

use Illuminate\Support\Facades\Facade;

class LaraHper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "LaraHper";
    }
}
