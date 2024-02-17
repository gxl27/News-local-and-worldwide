<?php

namespace App\Http\Controllers\Api;


use App\Services\LanguageService;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function __construct(
        protected LanguageService $languageService
    )
    {}

    public function index()
    {
        return response()->json($this->languageService->getAll());
    }

}
