<?php

namespace App\Services;

use App\Repositories\CountryRepository;


class CountryService
{

    public function __construct(
        protected CountryRepository $countryRepository,
    )
    {}

    public function getAll()
    {
        return $this->countryRepository->getAll();
    }
    
}