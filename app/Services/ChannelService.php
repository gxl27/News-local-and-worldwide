<?php

namespace App\Services;


use App\Models\User;
use App\Models\Channel;
use Illuminate\Support\Facades\Cache;
use App\Repositories\ChannelRepository;
use Illuminate\Support\Facades\Redis;

class ChannelService
{

    public function __construct(
        protected ChannelRepository $channelRepository
    )
    {}

    public function getPublicAllWithChannelLink()
    {
        $cacheKey = 'public_all_with_channel_link';
        $cachedChannels = Redis::get($cacheKey);
        if ($cachedChannels) {
            // If the data is in the cache, return it
            return $cachedChannels;
        }
        $channels = $this->channelRepository->getPublicAllWithChannelLink();
        Redis::set($cacheKey, $channels);

        return $channels;
    }

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

    public function create($data)
    {
        return $this->channelRepository->create($data);
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