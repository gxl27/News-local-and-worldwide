<?php

namespace App\Http\Controllers\Api\Admin;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\NewsEn;
use App\Models\NewsEs;
use App\Models\Region;
use App\Models\Country;
use App\Models\ChannelLink;
use App\Services\NewsService;
use App\Exceptions\ApiException;
use App\Rules\ChannelLinkExists;
use App\Services\ChannelService;
use App\Services\LanguageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\ChannelGroupService;
use App\Exceptions\NormalizerException;
use App\Models\ChannelGroup;

class ChannelGroupController extends Controller
{

    public function __construct(
        protected ChannelGroupService $channelGroupService,
    )
    {}

    public function index()
    {
        return response()->json($this->channelGroupService->getAll());
    }

    public function edit(ChannelGroup $channelgroup)
    {
        return response()->json([
            'channelgroup' => $channelgroup,
        ]);
    }

    public function store()
    {
        // validation
        $data = request()->validate([
            'name' => 'required|string',
            'channel_links' => 'required|array',
            'channel_links.*' => ['required', 'integer', new ChannelLinkExists],

        ]);
        $data['country_id'] = Country::find(request('country_id')) ? Country::find(request('country_id'))->id : null;
        $data['is_active'] = request()->has('is_active') ? request('is_active') : 0;
        $data['is_default'] = request()->has('is_default') ? request('is_default') : 0;
        $data['is_premium'] = request()->has('is_premium') ? request('is_premium') : 0;

        $channelGroup = $this->channelGroupService->create($data);

        return response()->json([
            'message' => 'ChannelGroup created successfully.',
            'channelgroup' => $channelGroup,
        ]);
    }

    public function update(ChannelGroup $channelgroup)
    {
        // validation
        $data = request()->validate([
            'name' => 'required|string',
            'channel_links' => 'required|array',
            'channel_links.*' => ['required', 'integer', new ChannelLinkExists],
        ]);

        $data['country_id'] = Country::find(request('country_id')) ? Country::find(request('country_id'))->id : null;
        $data['is_active'] = request()->has('is_active') ? request('is_active') : 0;
        $data['is_default'] = request()->has('is_default') ? request('is_default') : 0;
        $data['is_premium'] = request()->has('is_premium') ? request('is_premium') : 0;

        $channelgroup->update($data);

        return response()->json([
            'message' => 'Channelgroup updated successfully.',
            'channelgroup' => $channelgroup,
        ]);
    }

    public function destroy(ChannelGroup $channelgroup)
    {
        $channelgroup->delete();

        return response()->json([
            'message' => 'Channelgroup deleted successfully.',
        ]);
    }
    

}
