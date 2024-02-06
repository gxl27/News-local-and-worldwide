<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChannelLink;
use App\Services\ChannelLinkService;

class ChannelLinkController extends Controller
{

    public function __construct(
        protected ChannelLinkService $channelLinkService
    )
    {}
    // resorces
    public function index()
    {
        $channellinks = $this->channelLinkService->getAll();

        return response()->json([
            'channellinks' => $channellinks,
        ]);
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
            'category_id' => 'required|exists:categories,id',
            'channel_id' => 'required|exists:channels,id',
        ]);
        $data['is_active'] = request()->has('is_active') ? request('is_active') : 0;
        $data['priority'] = request()->has('priority') ? request('priority') : 0;
        $channellink = $this->channelLinkService->create($data);

        return response()->json([
            'message' => 'ChannelLink created successfully.',
            'channelLink' => $channellink,
        ]);
    }
    public function edit(ChannelLink $channellink)
    {
        return response()->json([
            'channelLink' => $channellink,
        ]);
    }
    public function update(ChannelLink $channellink)
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
            'category_id' => 'required|exists:categories,id',
            'channel_id' => 'required|exists:channels,id',
        ]);
        $data['is_active'] = request()->has('is_active') ? request('is_active') : $channellink->is_active;
        $data['priority'] = request()->has('priority') ? request('priority') : $channellink->priority;
        $channellink->update($data);

        return response()->json([
            'message' => 'ChannelLinks updated successfully.',
            'channelLink' => $channellink,
        ]);
    }
    public function destroy(ChannelLink $channellink)
    {
        $channellink->delete();

        return response()->json([
            'message' => 'ChannelLink deleted successfully.',
        ]);
    }
    
}
