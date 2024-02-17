<?php

namespace App\Http\Controllers\Api;


use App\Services\CountryService;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function __construct(
        protected CountryService $countryService
    )
    {}

    public function index()
    {
        return response()->json($this->countryService->getAll());
    }
    

}
