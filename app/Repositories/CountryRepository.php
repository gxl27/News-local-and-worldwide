<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Channel;
use App\Models\Country;
use App\Models\UserSetting;

class CountryRepository
{

    public function __construct(
        protected Country $country
    )
    {}

    public function getAll()
    {
        return $this->country::all()->sortBy('name');
    }

    public function getAllActive()
    {
        return $this->country->where('is_active', true)->sortBy('name')->get();
    }

    public function getById($id)
    {
        return $this->country->find($id);
    }

    public function getByIso($iso)
    {
        return $this->country->where('iso2', $iso)->first();
    }
}