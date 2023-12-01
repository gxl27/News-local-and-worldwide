<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\ChannelLink;
use Illuminate\Support\Facades\Http;
use App\Models\News;
use App\Services\RssNews\RssNewsSeekerService;
use Carbon\Carbon;

class RssNews extends Command
{
    protected $signature = 'rss:news';
    protected $description = 'Rss news seek service';

    public function __construct(
        protected RssNewsSeekerService $rssNewsSeekerService
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
        
        try {
            $this->rssNewsSeekerService->seekNews();
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            logger($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
