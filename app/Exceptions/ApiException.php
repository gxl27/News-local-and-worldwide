<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;
use Illuminate\Foundation\Exceptions\Handler;
use Throwable;

class ApiException extends InternalException
{
    public static function apiRssLinkFailed(?string $message = null): self
    {
        return self::new(ExceptionCode::ApiRssLinkFailed, $message);
    }
}
