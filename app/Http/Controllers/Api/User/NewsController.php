<?php

namespace App\Http\Controllers\Api\User;

use App\Exceptions\ApiException;
use App\Models\ChannelLink;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\News;
use App\Models\NewsEn;
use App\Models\NewsEs;
use App\Models\Region;
use App\Models\User;
use App\Services\NewsService;
use App\Services\ChannelService;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Services\LanguageService;
use App\Exceptions\NormalizerException;
use App\Traits\UserAuthorizationTrait;

class NewsController extends Controller
{

    use UserAuthorizationTrait;
    public function __construct(
        protected ChannelService $channelService,
        protected NewsService $newsService
    )
    {}

    public function index()
    {
        return response()->json($this->newsService->getPublicAll());
    }
    

    // public function show(int $id, string $languagesString)
    // {
    //     $languages = explode(',', $languagesString);
    //     $languages = array_map('ucfirst', $languages);
    //     $channelList = ChannelLink::find($id);
    //     $originalLanguage = $channelList->channel->language->code;
    //     $news = $this->newsService->getAllByChannelLinkWithTranslation($channelList, ucfirst($originalLanguage), $languages);
        
    //     return response()->json($news);
    // }

    public function getUserFeedByChannelLink(User $user)
    {   
        $this->passed($user);
        // some policy here
        // $this->authorize('passed', $user, $this->header('X-Api-Key')));
        $channelLinks = $user->userSetting->channel_links;

        // go in service and repository and check the cached channels,
        // the one that are not cached, cache them and return them
        // $cacheKey = 'public_all_with_channel_link';
        // $cachedChannels = Redis::get($cacheKey);
        // if ($cachedChannels) {
        //     return $cachedChannels;
        // }
        // $channels = $this->channelRepository->getPublicAllWithChannelLink();
        // Redis::set($cacheKey, $channels);

        dd($user->userSetting->channel_links);

        $languages = explode(',', $languagesString);
        $languages = array_map('ucfirst', $languages);
        $channelList = ChannelLink::find($id);
        $originalLanguage = $channelList->channel->language->code;
        $news = $this->newsService->getAllByChannelLinkWithTranslation($channelList, ucfirst($originalLanguage), $languages);
        
        return response()->json($news);
    }

}
