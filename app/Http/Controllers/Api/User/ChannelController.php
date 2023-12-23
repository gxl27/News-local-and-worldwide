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
use App\Models\ChannelLink;
use App\Services\NewsService;
use App\Exceptions\ApiException;
use App\Services\ChannelService;
use App\Services\LanguageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NormalizerException;

class ChannelController extends Controller
{

    public function __construct(
        protected ChannelService $channelService
    )
    {}

    public function index()
    {
        // get with channelLinks and channelLinks.category
        return response()->json($this->channelService->getPublicAllWithChannelLink());
    }

    public function show(NewsService $newsService, int $id, string $languagesString)
    {
        $languages = explode(',', $languagesString);
        $languages = array_map('ucfirst', $languages);
        $channelList = ChannelLink::find($id);
        $originalLanguage = $channelList->channel->language->code;
        $news = $newsService->getAllByChannelLinkWithTranslation($channelList, ucfirst($originalLanguage), $languages);
        
        return response()->json($news);
    }

}
