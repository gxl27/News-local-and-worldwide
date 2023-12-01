<?php

namespace App\Services\RssNews;

use App\Models\Channel;
use App\Models\ChannelLink;
use App\Models\News;
use App\Models\NewsEn;
use App\Models\NewsFr;
use App\Models\NewsEs;
use App\Models\NewsIt;
use App\Models\NewsDe;
use App\Models\NewsRo;
use App\Models\NewsPt;

use App\Services\ChannelService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class RssNewsSeekerService
{
    public function __construct(
        protected ChannelService $channelService
    ) 
    {}

    public function seekNews(): void
    {
        $channels = $this->channelService->getAllActive();

        foreach ($channels as $channel) {
            foreach ($channel->channelLinks as $channelLink) {
                if ($channelLink->is_active) {
                    try {
                        $this->seekNewsByChannelLink($channelLink);
                    } catch (\Throwable $th) {
                        throw $th;
                    }
                }
            }
        }
    }

    public function seekNewsByChannelLink(ChannelLink $channelLink): void
    {
        $response = Http::get($channelLink->link);
        $xmlResponse = simplexml_load_string($response->getBody()->getContents());
        $xmlChannelLink = json_decode(json_encode($xmlResponse), true);
        $items = $xmlChannelLink['channel']['item'];
        foreach ($items as $item) {
            
            $existingNews = News::where('uid', $item['guid'])->first();
            
            if (!$existingNews) {
                $transTitleRo = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['title'],
                    'source' => 'en',
                    'target' => 'ro'
                ]);
                
                $transDescriptionRo = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['description'],
                    'source' => 'en',
                    'target' => 'ro'
                ]);
    
                $transTitleEs = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['title'],
                    'source' => 'en',
                    'target' => 'es'
                ]);
    
                $transDescriptionEs = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['description'],
                    'source' => 'en',
                    'target' => 'es'
                ]);

                $transTitleFr = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['title'],
                    'source' => 'en',
                    'target' => 'fr'
                ]);
                
                $transDescriptionFr = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['description'],
                    'source' => 'en',
                    'target' => 'fr'
                ]);

                $transTitleIt = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['title'],
                    'source' => 'en',
                    'target' => 'it'
                ]);

                $transDescriptionIt = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['description'],
                    'source' => 'en',
                    'target' => 'it'
                ]);

                $transTitleDe = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['title'],
                    'source' => 'en',
                    'target' => 'de'
                ]);

                $transDescriptionDe = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['description'],
                    'source' => 'en',
                    'target' => 'de'
                ]);

                $transTitlePt = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['title'],
                    'source' => 'en',
                    'target' => 'pt'
                ]);

                $transDescriptionPt = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                    'q' => $item['description'],
                    'source' => 'en',
                    'target' => 'pt'
                ]);
                // dd($item['title']);
                // dd($trans->json()['translatedText']);
                $publishAt = Carbon::createFromFormat('D, d M Y H:i:s O', $item['pubDate'])->toDateTimeString();
                $news = new News([
                    'title'       => $item['title'],
                    'link'        => $item['link'],
                    'description' => $item['description'],
                    'publish_at'     => $publishAt,
                    'uid'        => $item['guid'],
                    'image' => null,
                    'channel_link_id' => $channelLink->id,

                    // Add other fields as needed
                ]);
                
                // Save the News model to the database
                $news->save();
                
                if ($transTitleRo->json()['translatedText'] && $transDescriptionRo->json()['translatedText']) {
                   
                    $newsTransRo = new NewsRo([
                        'title'       => $transTitleRo->json()['translatedText'],
                        'description' => $transDescriptionRo->json()['translatedText'],
                        'news_id' => $news->id
                    ]);
                    $newsTransRo->save();
                }
    
                if ($transTitleEs->json()['translatedText'] && $transDescriptionEs->json()['translatedText']) {
                    $newsTransEs = new NewsEs([
                        'title'       => $transTitleEs->json()['translatedText'],
                        'description' => $transDescriptionEs->json()['translatedText'],
                        'news_id' => $news->id
                    ]);
                    $newsTransEs->save();
                }

                if ($transTitleFr->json()['translatedText'] && $transDescriptionFr->json()['translatedText']) {
                    $newsTransFr = new NewsFr([
                        'title'       => $transTitleFr->json()['translatedText'],
                        'description' => $transDescriptionFr->json()['translatedText'],
                        'news_id' => $news->id
    
                        // Add other fields as needed
                    ]);
                    $newsTransFr->save();
                }

                if ($transTitleIt->json()['translatedText'] && $transDescriptionIt->json()['translatedText']) {
                    $newsTransIt = new NewsIt([
                        'title'       => $transTitleIt->json()['translatedText'],
                        'description' => $transDescriptionIt->json()['translatedText'],
                        'news_id' => $news->id
    
                        // Add other fields as needed
                    ]);
                    $newsTransIt->save();
                }

                if ($transTitleDe->json()['translatedText'] && $transDescriptionDe->json()['translatedText']) {
                    $newsTransDe = new NewsDe([
                        'title'       => $transTitleDe->json()['translatedText'],
                        'description' => $transDescriptionDe->json()['translatedText'],
                        'news_id' => $news->id
    
                        // Add other fields as needed
                    ]);
                    $newsTransDe->save();
                }

                if ($transTitlePt->json()['translatedText'] && $transDescriptionPt->json()['translatedText']) {
                    $newsTransPt = new NewsPt([
                        'title'       => $transTitlePt->json()['translatedText'],
                        'description' => $transDescriptionPt->json()['translatedText'],
                        'news_id' => $news->id
    
                        // Add other fields as needed
                    ]);
                    $newsTransPt->save();
                }
            }
        }
    }
    
}
