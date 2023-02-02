<?php

namespace App\Facades;

use App\Services\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void createUser(array $data)
 *
 * @see UserService
 */
class UserFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UserService::class;
    }
}
