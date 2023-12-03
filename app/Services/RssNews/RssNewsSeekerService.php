<?php

namespace App\Services\RssNews;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Channel;
use App\Models\Language;
use App\Models\ChannelLink;
use App\Exceptions\ApiException;
use App\Exceptions\InternalException;
use App\Services\ChannelService;
use App\Services\LanguageService;
use App\Services\NormalizerService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NormalizerException;

class RssNewsSeekerService
{
    public function __construct(
        protected ChannelService $channelService,
        protected LanguageService $languageService,
        protected NormalizerService $normalizerService
    ) 
    {}

    public function seekNews(Channel $specificChannel = null): void
    {
        $channels = $specificChannel ? [$specificChannel] : $this->channelService->getAllActive();

        foreach ($channels as $channel) {
            foreach ($channel->channelLinks as $channelLink) {
                if ($channelLink->is_active) {
                    $this->seekNewsByChannelLink($channelLink);
                }
            }
        }
    }

    public function seekNewsByChannelLink(ChannelLink $channelLink): void
    {
        try {
            $response = Http::get($channelLink->link);
        } catch (\Exception $e) {
            Log::channel('timeout_error')->error($e->getMessage(). " - Link: $channelLink->link");
            return;
        }
       
        if ($response->failed()) {
            Log::channel('timeout_error')->error("Api response failed - Link: $channelLink->link");
            return;
        }
        $this->normalizeData($response, $channelLink);
    }

    private function normalizeData(Response $response, ChannelLink $channelLink)
    {
        try {

            $normalizer = $this->normalizerService->getByChannelLink($channelLink);
            
            if (!$normalizer) {
                throw NormalizerException::normalizerChannelNotFound("Channel id: $channelLink->id");
            }

            $xmlResponse = simplexml_load_string($response->getBody()->getContents(), "SimpleXmlElement",LIBXML_NOCDATA);
            
            
            $mapper = $this->normalizerService->addMapper($normalizer);

            if (!$mapper) {
                throw NormalizerException::normalizerMapperCannotBeGenerated("Normalizer id: $normalizer->id");
            }

            $xmlChannelLink = json_decode(json_encode($xmlResponse), true);

            $items = $this->normalizerService->getItems($mapper, $xmlChannelLink, $channelLink->id);
            // if($normalizer->id == 8) {
            //     dd($items);
            // }
            if (!$items) {
                throw NormalizerException::normalizerDataFailed("Normalizer id: $normalizer->id - link: $channelLink->link");
            }
        } catch (InternalException $e) {
            return;
        }

        $defaultLang = ucfirst($channelLink->channel->language->code);
        $languages = $this->languageService->getNonDefaultLanguageSystem($defaultLang);
        foreach ($items as $item) {

            $existingNews = News::where('uid', $item['guid'])->first();
            if (!$existingNews) {
                try {

                    $publishAt = $item['pubDate'] ?
                        Carbon::createFromFormat('D, d M Y H:i:s O', $item['pubDate'])->toDateTimeString() :
                        (new \DateTime())->format('D, d M Y H:i:s O');
                    
                        $news = new News([
                        'title'       => $item['title'],
                        'link'        => $item['link'],
                        'description' => $item['description'],
                        'publish_at'     => $publishAt,
                        'uid'        => $item['guid'],
                        'image' => null,
                        'channel_link_id' => $channelLink->id,
                    ]);
                    
                    $news->save();
                } catch (\Exception $e) {
                    Log::channel('news_error')->error($e->getMessage(). " - Link: $channelLink->link | 'NewsData:  ". print_r($item, true));
                    continue;
                }
                
                // translation
                try {
                    foreach ($languages as $language) {
                        ${"trans" . $language['name']} = Http::post(env('TRANSLATE_ADDRESS')."translate", [
                            'q' => [$item['title'], $item['description']],
                            'source' => strtolower($defaultLang),
                            'target' => strtolower($language['name'])
                        ]);
                        ${"transArray" . $language['name']} = ${"trans" . $language['name']}->json()['translatedText'];
                        
                        $className = 'App\Models\News' . ucfirst($language['name']);
                        if(${"transArray" . $language['name']} && class_exists($className) && (${"transArray" . $language['name']}[0]) && (${"transArray" . $language['name']}[0])) {
                            
                            $className::create([
                                'title'       => ${"transArray" . $language['name']}[0],
                                'description' => ${"transArray" . $language['name']}[1],
                                'news_id' => $news->id
                            ]);
                        }
                    }
                    
                } catch (\Exception $e) {
                    Log::channel('translation_error')->error($e->getMessage(). " - Link: $channelLink->link | 'NewsData:  ". print_r($item, true));
                    continue;
                }
            }
        }
        
        
        return $normalizer;
    }
}
