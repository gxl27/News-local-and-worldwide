<?php

namespace App\Traits;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Exceptions\InternalException;

trait CommandExceptionHandler
{
    protected function handleException(\Exception $e)
    {
        if ($e instanceof InternalException) {
            $code = $e->getInternalCode();
            $logChannel = $code->getLogFile();
            Log::channel($logChannel)->error($e->getMessage());
            $this->error("Error ($logChannel) : ". $e->getMessage());
        } else {
            // if it's not a custom exception
            logger($e->getMessage());
            $this->error("Error: ". $e->getMessage());
        }
    }
}