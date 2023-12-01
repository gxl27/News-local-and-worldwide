<?php

namespace App\Http\Controllers;

use App\Models\ChannelLink;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\News;
use App\Models\NewsEn;
use App\Models\NewsEs;
use App\Models\Region;
use App\Models\User;
use App\Services\NewsService;
use Carbon\Carbon;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(NewsService $newsService)
    {
        

    }

    public function show(NewsService $newsService, int $id, string $defaultLanguage, string $languagesString)
    {
        $languages = explode(',', $languagesString);
        $languages = array_map('ucfirst', $languages);
        $channelList = ChannelLink::find($id);
        $news = $newsService->getAllByChannelLinkWithTranslation($channelList, ucfirst($defaultLanguage), $languages);
        
        return response()->json($news);
    }

}
