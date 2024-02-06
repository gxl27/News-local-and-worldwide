<?php

namespace App\Rules;

use App\Models\ChannelLink;
use Illuminate\Contracts\Validation\Rule;

class ChannelLinkExists implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the channel link with the given ID exists in the database
        return ChannelLink::where('id', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected channel link is invalid.';
    }
}
