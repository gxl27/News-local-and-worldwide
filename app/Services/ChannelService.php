<?php

namespace App\Services;


use App\Models\Channel;
use App\Models\User;
use App\Repositories\ChannelRepository;

class ChannelService
{

    public function __construct(
        protected ChannelRepository $channelRepository
    )
    {}

    public function getAll()
    {
        return $this->channelRepository->getAll();
    }

    public function getById($id)
    {
        return $this->channelRepository->getById($id);
    }

    public function getAllActive()
    {
        return $this->channelRepository->getAllActive();
    }

    public function getAllWithChannelLinks()
    {
        return $this->channelRepository->getAllWithChannelLinks();
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