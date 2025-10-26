<?php
namespace Laragetmodel\GetModel\Facades;

use Illuminate\Support\Facades\Facade;

class GetModel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'getmodel';
    }
}
