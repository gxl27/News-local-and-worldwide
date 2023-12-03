<?php

namespace App\Services;


use App\Enums\LanguageSystem;
use App\Repositories\LanguageRepository;

class LanguageService
{

    public function __construct(
        protected LanguageRepository $languageRepository
    )
    {}

    public function getAll()
    {
        return $this->languageRepository->getAll();
    }

    public function getById($id)
    {
        return $this->languageRepository->getById($id);
    }

    public function getAllActive()
    {
        return $this->languageRepository->getAllActive();
    }

    public function getNonDefaultLanguageSystem(string $defaultLanguage)
    {
        return $this->languageRepository->getNonDefaultLanguageSystem($defaultLanguage);
    }

    // public function getChannelsByUser(User $user)
    // {
    //     return $this->channelRepository->getChannelsByUser($user);
    // }

    // public function getChannelsByUserAndCountry(User $user, $countryId)
    // {
    //     return $this->channelRepository->getChannelsByUserAndCountry($user, $countryId);
    // }

    // public function getChannelsByUserAndLanguage(User $user, $languageId)
    // {
    //     return $this->channelRepository->getChannelsByUserAndLanguage($user, $languageId);
    // }

    // public function getChannelsByUserAndCountryAndLanguage(User $user, $countryId, $languageId)
    // {
    //     return $this->channelRepository->getChannelsByUserAndCountryAndLanguage($user, $countryId, $languageId);
    // }

    // public function getChannelsByCountry($countryId)
    // {
    //     return $this->channelRepository->getChannelsByCountry($countryId);
    // }

    // public function getChannelsByLanguage($languageId)
    // {
    //     return $this->channelRepository->getChannelsByLanguage($languageId);
    // }

    // public function getChannelsByCountryAndLanguage($countryId, $languageId)
    // {
    //     return $this->channelRepository->getChannelsByCountryAndLanguage($countryId, $languageId);
    // }
}