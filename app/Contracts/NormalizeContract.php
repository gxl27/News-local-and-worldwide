<?php

namespace App\Contracts;

interface NormalizeContract
{
    public function normalize(array $data): array|null;
}