<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\ChannelLink;
use Illuminate\Support\Facades\Http;
use App\Models\News;
use App\Services\RssNews\RssNewsSeekerService;
use App\Services\NewsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DeleteNewsByChannel extends Command
{
    protected $signature = 'news:delete {channelLinkId}';
    protected $description = 'Delete news by channel link ID';

    public function __construct(
        protected NewsService $newsService
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {

        $channelLinkId = $this->argument('channelLinkId');
        $validator = Validator::make(['channelLinkId' => $channelLinkId], [
            'channelLinkId' => 'required|exists:channel_links,id',
        ]);

        if ($validator->fails()) {
            $this->error("Invalid channelLinkId: $channelLinkId");
            return Command::FAILURE;
        }

        try {
            $channelLink = ChannelLink::find($channelLinkId);
            $this->newsService->deleteAllByChannelLink($channelLink);
            $this->info("News deleted for channel link ID: $channelLinkId");
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            logger($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
