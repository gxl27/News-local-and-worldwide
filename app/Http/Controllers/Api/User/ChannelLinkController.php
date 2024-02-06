<?php

namespace App\Http\Controllers\Api\User;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\NewsEn;
use App\Models\NewsEs;
use App\Models\Region;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Language;
use App\Models\ChannelLink;
use App\Services\NewsService;
use App\Exceptions\ApiException;
use App\Services\LanguageService;
use App\Http\Controllers\Controller;
use App\Services\ChannelLinkService;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NormalizerException;

class ChannelLinkController extends Controller
{

    public function __construct(
        protected ChannelLinkService $channelLinkService,
        protected NewsService $newsService
    )
    {}

    public function index(User $user)
    {
        $channelLinks = $user->userSetting->channel_links;
        $language = request('translate') ? $user->userSetting->language : null;
        $channelLinksArray = [];
        
        foreach ($channelLinks as $channelLink) {
            $channelLinksArray[$channelLink] = $this->show($channelLink);
        }
        $channelLinksArray = $this->channelLinkService->removeTranslationExcept($channelLinksArray, $language);

        return response()->json([
            'channellinks' => $channelLinksArray,
        ]);
    }

    public function show($channellinkId)
    {
        $channellink = ChannelLink::find($channellinkId);
        if ($channellink === null) {
           return null;
        }
        
        return $this->newsService->getAllByChannelLink($channellink);
    }

}
