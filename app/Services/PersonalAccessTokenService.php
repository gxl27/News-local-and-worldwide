<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Constants\Config;
use App\Models\PersonalAccessToken;


class PersonalAccessTokenService
{
    public function __constructor(
        protected PersonalAccessToken $token
    )
    {}

    public function generateToken(User $user) :PersonalAccessToken
    {
        $oldToken = $user->tokens->first();
        if ($oldToken) {
            $oldToken->delete();
        }
        $token = $user->createToken('auth-token', ['*'], now()->addDays(Config::USER_TOKEN_EXPIRATION_DAYS));
        
        return $token->save();
    }


    public function checkToken(PersonalAccessToken $token)
    {
        $expirationDate = Carbon::parse($token->expires_at);

        // Compare the expiration date with today's date
        return $expirationDate->isAfter(Carbon::today());
    }

    public function refreshToken(PersonalAccessToken $token)
    {
        $token->update([
            'token' =>
            'expires_at' => Carbon::now()->addDays(Config::USER_TOKEN_EXPIRATION_DAYS)
        ]);
    }
    
}