<?php

namespace App\Listeners;

use App\Events\ChannelLinkNewsSaved;
use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChannelLinkNewsSavedListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(
        protected NewsRepository $newsRepository
    )
    {
    }

    public function handle(ChannelLinkNewsSaved $event)
    {
        $news = $this->newsRepository->getAllByChannelLink($event->channelLink);
    }
}
