<?php

namespace App\Events;

use App\Models\ChannelLink;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChannelLinkNewsSaved

{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channelLink;

    public function __construct(ChannelLink $channelLink)
    {
        $this->channelLink = $channelLink;
    }
}
