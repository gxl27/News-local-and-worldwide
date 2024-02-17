<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Constants\Config;
use App\Models\PersonalAccessToken;


class PersonalAccessTokenService
{
    public function __construct(
        protected PersonalAccessToken $token
    )
    {}

    public function generateToken(User $user) :void
    {
        $oldToken = $user->tokens->first();
        if ($oldToken) {
            $oldToken->delete();
        }
        $token = $user->createToken('auth-token', ['*'], now()->addDays(Config::USER_TOKEN_EXPIRATION_DAYS));

    }


    public function checkToken(PersonalAccessToken $token)
    {
        $expirationDate = Carbon::parse($token->expires_at);

        // Compare the expiration date with today's date
        return $expirationDate->isAfter(Carbon::today());
    }

}