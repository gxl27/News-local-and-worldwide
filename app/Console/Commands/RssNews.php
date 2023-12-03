<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\News;

use App\Models\ChannelLink;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Exceptions\InternalException;
use App\Services\RssNews\RssNewsSeekerService;

class RssNews extends CommandWithExceptionTrait
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
            // the exception is handled by the trait
            $this->handleException($e);
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
