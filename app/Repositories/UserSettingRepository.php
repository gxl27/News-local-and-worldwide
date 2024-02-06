<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Language;
use App\Models\UserSetting;

class UserSettingRepository
{

    public function __construct(
        protected UserSetting $userSetting,
        protected ChannelLinkRepository $channelLinkRepository,
        protected CountryRepository $countryRepository,
        protected ChannelGroupRepository $channelGroupRepository,
    )
    {}

    public function getUserSettingByAuth()
    {
        return $this->userSetting->where('user_id', auth()->user()->id)->first();
    }

    public function generateDefault(User $user, Country $country, Language $language)
    { // generate default for countries (not all the channels from taht country but a limit of defaults)
        $channlGroup = $this->channelGroupRepository->getDefault($country->id);

        // $channelLinks = $this->channelLinkRepository->getByIso($this->countryRepository->getByIso('US')->id);
      
        // $channelLinksIds = $channelLinks->pluck('id')->toArray();
        $userSetting = $this->userSetting->create([
            'user_id' => $user->id,
            'country_id' => $country->id,
            'language_id' => $language->id,
            'channel_links' => $channlGroup->channel_links,
            'is_active' => true,
        ]);

        return $userSetting;
    }
}