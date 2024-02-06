<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Channel;
use App\Models\ChannelLink;
use App\Models\Country;
use App\Models\UserSetting;
use App\Constants\Config;

class ChannelLinkRepository
{

    public function __construct(
        protected ChannelLink $channelLink
    )
    {}

    public function getAll()
    {
        return $this->channelLink->all();
    }

    public function getById($id)
    {
        return $this->channelLink->find($id);
    }

    public function getAllActive()
    {
        return $this->channelLink->where('is_active', true)->get();
    }

    public function create($data)
    {
        return $this->channelLink->create($data);
    }

    public function filterNotPremium(array $channelLinksArray)
    {
        $ids = array_values($channelLinksArray);
        $channelLinks  = $this->channelLink::whereIn('id', $ids)->where('is_premium', 0)->limit(Config::USER_MAX_CHANNEL_LINKS)->get();

        $channelLinksIds = $channelLinks->pluck('id')->map(function ($id) {
            return (string)$id;
        })->toArray();

        return $channelLinksIds;
    }

    public function limitMaxChannelLinks(array $channelLinksArray)
    {
        if (count($channelLinksArray) > Config::PREMIUM_MAX_CHANNEL_LINKS) {
            $channelLinksArray = array_slice($channelLinksArray, 0, Config::PREMIUM_MAX_CHANNEL_LINKS);
        }

        return $channelLinksArray;
    }
}