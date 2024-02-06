<?php

namespace App\Repositories;

use App\Models\Channel;
use App\Models\ChannelGroup;
use App\Models\UserSetting;

class ChannelGroupRepository
{

    public function __construct(
        protected ChannelGroup $channelGroup
    )
    {}

    public function getAll()
    {
        return $this->channelGroup::all()->sortBy('name');
    }

    public function getAllActive()
    {
        return $this->channelGroup->where('is_active', true)->sortBy('name')->get();
    }

    public function getById($id)
    {
        return $this->channelGroup->find($id);
    }

    public function create($data)
    {
        // $data['channel_links'] = json_encode($data['channel_links']);
        // $data['channel_links'] = json_decode($data['channel_links']);
        return $this->channelGroup->create($data);
    }

    public function update($id, $data)
    {
        $channelGroup = $this->getById($id);
        $channelGroup->update($data);
        return $channelGroup;
    }

    public function delete($id)
    {
        $channelGroup = $this->getById($id);
        $channelGroup->delete();
        return $channelGroup;
    }

    public function getDefault(int $countryId)
    {
        $channelGroup = $this->channelGroup->where('country_id', $countryId)->where('is_default', true)->first();
        if (!$channelGroup) {
            $channelGroup = $this->channelGroup->where('name', 'Standard')->first();
        }
        return $channelGroup;
    }
}