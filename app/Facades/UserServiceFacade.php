<?php

namespace App\Facades;

use App\Services\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static login( mixed $cred) authorize user
 * @method static register( mixed $cred) register new user
 * @see UserService
 *
 */
class UserServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserService::class;
    }

}
