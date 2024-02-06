<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Channel;
use App\Services\ChannelService;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{

    public function __construct(
        protected ChannelService $channelService
    )
    {
        
    }
        
    // resorces
    public function index()
    {
        $channels = $this->channelService->getAll();

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
            'icon' => 'required',
        ]);

        $channel = $this->channelService->create($data);

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
            'country_id' => 'required|exists:countries,id',
            'language_id' => 'required|exists:languages,id',
            'icon' => 'required',
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
