<?php

namespace App\Services;

use App\Models\Channel;
use App\Models\ChannelLink;
use App\Repositories\NewsRepository;

class NewsService
{

    public function __construct(
        protected NewsRepository $newsRepository
    )
    {}

    public function getAllByChannelLink(ChannelLink $channelLink)
    {
        return $this->newsRepository->getAllByChannelLink($channelLink);
    }

    public function getAllByChannelLinkWithTranslation(ChannelLink $channelLink, string $originalLanguage, array $languages=[])
    {
        return $this->newsRepository->getAllByChannelLinkWithTranslation($channelLink, $originalLanguage, $languages);
    }

    public function getById($id)
    {
        return $this->newsRepository->getById($id);
    }

    public function deleteAllByChannelLink(ChannelLink $channelLink)
    {
        return $this->newsRepository->deleteAllByChannelLink($channelLink);
    }

    public function deleteAllByChannel(Channel $channel)
    {
        return $this->newsRepository->deleteAllByChannel($channel);
    }

    public function delete($id)
    {
        return $this->newsRepository->delete($id);
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