<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Channel;
use App\Services\NewsService;
use Illuminate\Support\Facades\Validator;

class DeleteNewsByChannel extends CommandWithExceptionTrait
{
    protected $signature = 'news:delete {channelId}';
    protected $description = 'Delete news by channel ID';

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

        $channelId = $this->argument('channelId');
        $validator = Validator::make(['channelId' => $channelId], [
            'channelId' => 'required|exists:channels,id',
        ]);

        if ($validator->fails()) {
            $this->error("Invalid channelId: $channelId");
            return Command::FAILURE;
        }

        try {
            $channel = Channel::find($channelId);
            $this->newsService->deleteAllByChannel($channel);
            $this->info("News deleted for channel ID: $channelId");
        } catch (\Exception $e) {
            // the exception is handled by the trait
            $this->handleException($e);
        }

        return Command::SUCCESS;
    }
}
