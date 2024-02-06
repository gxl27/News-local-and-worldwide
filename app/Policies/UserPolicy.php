<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function passed(User $authenticatedUser, User $userFromHeader)
    {
        // Check if the user in the header matches the authenticated user
        return $authenticatedUser->id === $userFromHeader->id;
    }
}
