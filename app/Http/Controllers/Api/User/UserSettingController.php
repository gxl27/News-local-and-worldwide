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
use App\Services\ChannelLinkService;

class UserSettingController extends Controller
{

    public function __construct(
        protected ChannelService $channelService,
        protected NewsService $newsService,
        protected ChannelLinkService $channelLinkService,
    )
    {}

    public function edit(User $user)
    {
        // if (auth()->user()->id !== $user->id) {
        //     throw new ApiException('You are not authorized to access this resource', 403);
        // }
        $user->load('userSetting');

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(User $user)
    {
        request('id') == $user->userSetting->id ?: abort(403, 'You are not authorized to access this resource');

        $data = request()->validate([
            'id' => 'required|exists:user_settings,id',
            'channel_links' => 'required|array',
            'channel_links.*' => 'required|integer|exists:channel_links,id',
        ]);
        $hasSubscription = $user->userSubscription->is_active;

        if (!$hasSubscription) {
            $data['channel_links'] = $this->channelLinkService->filterNotPremium($data['channel_links']);
            
        }

        $data['channel_links'] = $this->channelLinkService->limitMaxChannelLinks($data['channel_links']);

        $user->userSetting->update($data);

        return response()->json([
            'message' => 'User setting updated successfully.',
            'user' => $user,
        ]);
    }

}
