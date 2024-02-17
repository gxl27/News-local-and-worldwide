<?php 

namespace App\Traits;

use App\Models\User;
use App\Models\PersonalAccessToken;


trait UserAuthorizationTrait
{

    public function passed(User $requestedUser) 
    {
        $passed = $this->sameUserOrAdmin($requestedUser);

        if (!$passed) {
            $message = 'Not permited!';

            return response()->json([
                'message' => $message,
            ],401);
        }

        return;

    }

    public function sameUserOrAdmin(User $requestedUser) :bool
    {
        $userFromHeader = $this->getUserFromHeader();

        if (!$userFromHeader) {
            return false;
        }

        if (
            $userFromHeader->hasRole('admin') ||
            ($userFromHeader->id === $requestedUser->id)
        ) {
            return true;
        }

        return false;
    }

    private function getUserFromHeader()
    {
        $apiToken = request()->header('X-Api-Key') ?? request()->header('X-Api-Key-Admin');
        
        if (!$apiToken) {
            return false;
        }
        
        $user = PersonalAccessToken::where('token', $apiToken)->first();
        
        return $user;
    }
}