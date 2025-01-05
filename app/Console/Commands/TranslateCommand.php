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

class TranslateCommand extends CommandWithExceptionTrait
{
    protected $signature = 't:t {sentence}';
    protected $description = 'Translate a sentence';

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

        $text = $this->argument('sentence');

        $translation = Http::post(env('TRANSLATE_ADDRESS')."translate", [
            'q' => [$text, $text],
            'source' => strtolower('en'),
            'target' => strtolower('fr'),
        ]);

        echo $translation . "\n";
        return Command::SUCCESS;
    }
}
