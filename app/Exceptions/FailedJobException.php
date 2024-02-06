<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;
use Illuminate\Foundation\Exceptions\Handler;
use Throwable;

class FailedJobException extends InternalException
{
    public static function newsFailedJob(?string $message = null): self
    {
        return self::new(ExceptionCode::NewsFailedJob, $message);
    }
}
