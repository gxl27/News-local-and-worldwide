<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Channel;

class ChannelController extends Controller
{
    // resorces
    public function index()
    {
        $channels = Channel::all();

        return response()->json([
            'channels' => $channels,
        ]);
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            // check country id_exists in countries table
            'country_id' => 'required|exists:countries,id',
            'language_id' => 'required|exists:languages,id',
        ]);

        $data['icon'] = request('icon');
        $data['is_active'] = true;
        $channel = Channel::create($data);

        return response()->json([
            'message' => 'Category created successfully.',
            'channel' => $channel,
        ]);
    }
    public function edit(Channel $channel)
    {
        return response()->json([
            'channel' => $channel,
        ]);
    }
    public function update(Channel $channel)
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $channel->update($data);

        return response()->json([
            'message' => 'Channel updated successfully.',
            'channel' => $channel,
        ]);
    }
    public function destroy(Channel $channel)
    {
        $channel->delete();

        return response()->json([
            'message' => 'Channel deleted successfully.',
        ]);
    }
    
}
