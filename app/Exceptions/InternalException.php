<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;
use Illuminate\Foundation\Exceptions\Handler;
use Throwable;

class InternalException extends \Exception
{

    protected string $description;
    protected ExceptionCode $intenalCode;
    
    public static function new(
        ExceptionCode $code,
        ?string $message = null,
        ?string $description = null,
        ?int $statusCode = null,
    ): static
    {
        $message = $message ? $code->getMessage() . " | " . $message : $code->getMessage();
        $exception = new static(
            $message,
            $statusCode ?? $code->getStatusCode(),
        );
        
        // dd($code->getDescription());
        $exception->intenalCode = $code;
        $exception->description = $description ?? $code->getDescription();
        
        return $exception;
    }

    public function getInternalCode(): ExceptionCode
    {
        return $this->intenalCode;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
