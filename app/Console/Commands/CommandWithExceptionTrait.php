<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\ChannelLink;
use Illuminate\Support\Facades\Http;
use App\Models\News;
use App\Services\RssNews\RssNewsSeekerService;
use App\Services\NewsService;
use App\Traits\CommandExceptionHandler;


class CommandWithExceptionTrait extends Command
{
    use CommandExceptionHandler;
    protected $signature = 'extendscommand';
    protected $description = 'extends';

    public function __construct(
    )
    {
        parent::__construct();
    }
}
