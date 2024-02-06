<?php

namespace App\Services;


use App\Models\User;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Repositories\ChannelRepository;
use App\Repositories\UserSettingRepository;

class UserSettingService
{

    public function __construct(
        protected UserSettingRepository $userSettingRepository
    )
    {}

    public function getUserSettingByAuth()
    {
        return $this->userSettingRepository->getUserSettingByAuth();
    }

    public function generateDefault(User $user, Country $country, Language $language)
    {
        return $this->userSettingRepository->generateDefault($user, $country, $language);
    }
}