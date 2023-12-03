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

class DeleteAllNews extends CommandWithExceptionTrait
{
    protected $signature = 'news:deleteAll';
    protected $description = 'Delete all news';

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

        News::all()->each(function ($news) {
            $news->delete();
        });

        return Command::SUCCESS;
    }
}
