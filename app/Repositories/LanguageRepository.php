<?php

namespace App\Repositories;

use App\Models\Language;
use App\Enums\LanguageSystem;

class LanguageRepository
{

    public function __construct(
        protected Language $language
    )
    {}

    public function getAll()
    {
        return $this->language->all();
    }

    public function getAllActive()
    {
        return $this->language->where('is_active', true)->get();
    }

    public function getById($id)
    {
        return $this->language->find($id);
    }

    public function getNonDefaultLanguageSystem(string $defaultLanguage)
    {
        $languageSystem = LanguageSystem::getAllValues();
        return array_filter($languageSystem, function ($language) use ($defaultLanguage) {
            return $language['name'] != $defaultLanguage;
        });
    }



}