<?php

namespace App\Repositories;

use App\Models\Channel;

class ChannelRepository
{

    public function __construct(
        protected Channel $channel
    )
    {}

    public function getPublicAllWithChannelLink()
    {
        return $this->channel::with('channelLinks')->with('channelLinks.category')->get();
    }

    public function getAll()
    {
        return $this->channel->all();
    }

    public function getAllActive()
    {
        return $this->channel->where('is_active', true)->get();
    }

    public function getById($id)
    {
        return $this->channel->find($id);
    }

    public function getAllWithChannelLinks()
    {
        return $this->channel->with('channelLinks')->get();
    }

    public function create($data)
    {
        return $this->channel->create($data);
    }
}