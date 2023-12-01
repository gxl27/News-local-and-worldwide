<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChannelLink;

class ChannelLinkController extends Controller
{
    // resorces
    public function index()
    {
        $channelLinks = ChannelLink::all();

        return response()->json([
            'channelLinks' => $channelLinks,
        ]);
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $channelLink = ChannelLink::create($data);

        return response()->json([
            'message' => 'ChannelLink created successfully.',
            'channelLink' => $channelLink,
        ]);
    }
    public function edit(ChannelLink $channelLink)
    {
        return response()->json([
            'channelLink' => $channelLink,
        ]);
    }
    public function update(ChannelLink $channelLink)
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $channelLink->update($data);

        return response()->json([
            'message' => 'ChannelLinks updated successfully.',
            'channelLink' => $channelLink,
        ]);
    }
    public function destroy(ChannelLink $channelLink)
    {
        $channelLink->delete();

        return response()->json([
            'message' => 'ChannelLink deleted successfully.',
        ]);
    }
    
}
