<?php

namespace App\Enums;

enum ExceptionCode: int
{
    case ApiRssLinkFailed = 400;
    case NewsFailedJob = 444;
    case NormalizerChannelNotFound = 1000;

    case NormalizerMapperCannotBeGenerated = 1002;
    case NormalizerJsonStructureNotMatched = 1005;
    case NormalizerDataFailed = 1010;

    public function getStatusCode() :string
    {
        $value = $this->value;

        return match(true) 
        {
            $value >= 1000 => 502,
            $value >= 400 => 503,
            default => 500
        };
    }

    public function getLogFile(): ?string
    {
        $value = $this->value;

        return match(true) 
        {
            $value >= 1000 => 'normalizer_error',
            $value >= 444 => 'failed_job',
            $value >= 400 => 'api_error',
            default => 'errorlog'
        };
    }

    public function getMessage(): ?string
    {
        $key = "exceptions.{$this->value}.message";
        $translation = __($key);

        if ($key === $translation) {
            return "something went wrong";
        }

        return $translation;
    }

    public function getDescription(): ?string
    {
        $key = "exceptions.{$this->value}.description";
        $translation = __($key);

        if ($key === $translation) {
            return "No edditional description";
        }

        return $translation;
    }

}