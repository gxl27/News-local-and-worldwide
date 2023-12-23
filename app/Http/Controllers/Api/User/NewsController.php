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

class NewsController extends Controller
{

    public function __construct(
        protected ChannelService $channelService,
        protected NewsService $newsService
    )
    {}

    public function index()
    {
        return response()->json($this->newsService->getPublicAll());
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
