<?php

namespace App\Services;


use App\Models\User;
use App\Models\Channel;
use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Repositories\ChannelRepository;
use App\Repositories\UserSubscriptionRepository;

class UserSubscriptionService
{

    public function __construct(
        protected UserSubscriptionRepository $userSubscriptionRepository
    )
    {}

    public function generateDefault(User $user)
    {
        return $this->userSubscriptionRepository->generateDefault($user);
    }
}