<?php

namespace App\Jobs;

use App\Models\Channel;
use App\Models\ChannelLink;
use App\Models\News;
use App\Services\NormalizerService;
use App\Services\RssNews\RssNewsSeekerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Batchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SearchNewsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $channelLink;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ChannelLink $channelLink = null)
    {
        $this->channelLink = $channelLink;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(RssNewsSeekerService $rssNewsSeekerService)
    {
        $rssNewsSeekerService->seekNewsByChannelLink($this->channelLink);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::channel('failed_job')->error("Channel id: " . $this->channelLink->id . " - " . $exception->getMessage());
    }

}