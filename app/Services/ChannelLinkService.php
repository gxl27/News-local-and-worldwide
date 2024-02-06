<?php

namespace App\Services;


use App\Enums\LanguageSystem;
use App\Models\User;
use App\Models\Channel;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Repositories\ChannelRepository;
use App\Repositories\ChannelLinkRepository;

class ChannelLinkService
{

    public function __construct(
        protected ChannelLinkRepository $channelLinkRepository,
    )
    {}

    public function getAll()
    {
        return $this->channelLinkRepository->getAll();
    }

    public function getById($id)
    {
        return $this->channelLinkRepository->getById($id);
    }

    public function getAllActive()
    {
        return $this->channelLinkRepository->getAllActive();
    }

    

    public function create($data)
    {
        return $this->channelLinkRepository->create($data);
    }

    public function filterNotPremium(array $channelLinksArray)
    {
        return $this->channelLinkRepository->filterNotPremium($channelLinksArray);
    }

    public function limitMaxChannelLinks(array $channelLinksArray)
    {
        return $this->channelLinkRepository->limitMaxChannelLinks($channelLinksArray);
    }

    public function removeTranslationExcept(array $channelLinksArray, ?Language $language)
    {
        if ($language) {
            $languagesKeyArray = LanguageSystem::EN->getAllKeysArrayMethodsExcept($language->code);
        } else {
            $languagesKeyArray = LanguageSystem::EN->getAllKeysArrayMethods();
        }
        foreach ($languagesKeyArray as $key => $value) {
            $languagesKeyArray[$key] = "news_" . strtolower($value);
        }
        foreach ($channelLinksArray as $key => $channelLink) {
            // $channelLinksArray[$key] = 21;
            // dd($channelLink);
            foreach ($channelLink as $secondKey => $news) {

                
                foreach ($languagesKeyArray as $newsLanguageKey) {
                    if (array_key_exists($newsLanguageKey, $news)) {
                        unset($channelLinksArray[$key][$secondKey][$newsLanguageKey]);
                    }
                }
            }
        }

        return $channelLinksArray;
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