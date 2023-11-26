<?php

namespace App\Http\Controllers;

use App\Models\ChannelLink;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\News;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

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

        return view('home');
    }
}
