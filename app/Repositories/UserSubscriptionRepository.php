<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Channel;
use App\Models\Country;
use App\Models\UserSubscription;

class UserSubscriptionRepository
{

    public function __construct(
        protected UserSubscription $userSubscription,
    )
    {}

    public function generateDefault(User $user)
    {

        $userSubscription = $this->userSubscription->create([
            'user_id' => $user->id,
            'is_active' => false,
        ]);

        return $userSubscription;
    }
}