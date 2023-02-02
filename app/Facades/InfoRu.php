<?php

namespace App\Facades;

use App\Services\InforuSMSService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void sendMessage(string $phoneNumber, string $message)
 * @method static bool isServiceEnabled()
 *
 * @see InforuSMSService
 */
class InfoRu extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return InforuSMSService::class;
    }
}
