<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;
use Illuminate\Foundation\Exceptions\Handler;
use Throwable;

class NormalizerException extends InternalException
{
    public static function normalizerChannelNotFound(?string $message = null): self
    {
        return self::new(ExceptionCode::NormalizerChannelNotFound, $message);
    }

    public static function normalizerMapperCannotBeGenerated(?string $message = null): self
    {
        return self::new(ExceptionCode::NormalizerMapperCannotBeGenerated, $message);
    }

    public static function normalizerJsonStructureNotMatched(?string $message = null): self
    {
        return self::new(ExceptionCode::NormalizerJsonStructureNotMatched, $message);
    }

    public static function normalizerDataFailed(?string $message = null): self
    {
        return self::new(ExceptionCode::NormalizerDataFailed, $message);
    }
}
