<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\ChannelLink;
use Illuminate\Support\Facades\Http;
use App\Models\News;
use Carbon\Carbon;

class UpdateNews extends Command
{
    protected $signature = 'news:update';
    protected $description = 'Update news';

    public function __construct()
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
            $channel = ChannelLink::all()->first();
            $response = Http::get($channel->link);
            $xmlResponse = simplexml_load_string($response->getBody()->getContents());
            
            // $news = News::create([
            //     name
            // ])
            $channel = json_decode(json_encode($xmlResponse), true);
            $items = $channel['channel']['item'];
            foreach ($items as $item) {
                $publishAt = Carbon::createFromFormat('D, d M Y H:i:s O', $item['pubDate'])->toDateTimeString();
                $news = new News([
                    'title'       => $item['title'],
                    'link'        => $item['link'],
                    'short_description' => $item['description'],
                    'description' => $item['description'],
                    'publish_at'     => $publishAt,
                    'publish_updated_at'     => $publishAt,
                    'uid'        => $item['guid'],
                    'image' => null
                    // Add other fields as needed
                ]);
        
                // Save the News model to the database
                $news->save();
            }
        } catch (\Exception $e) {
            logger($e->getMessage());
        }

        // if (isset($weight) && is_numeric($weight)) {
        //     if ($weight !== cache('current_weight')) {
        //         cache(['current_weight' => $weight]);
        //         broadcast(new ScaleWeightEvent($weight));
        //     }
        // }

        return Command::SUCCESS;
    }
}
