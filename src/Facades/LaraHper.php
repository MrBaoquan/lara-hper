<?php
namespace Mrba\LaraHper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Admin.
 *
 * @method static \MrBa\LaraHper\Models\User Administrator()
 * @method static \MrBa\LaraHper\Models\User user()
 *
 * @see \MrBa\LaraHper\LaraHper
 */

class LaraHper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "LaraHper";
    }
}
