<?php

namespace App\Repositories;

use App\Models\Normalizer;

class NormalizerRepository
{

    public function __construct(
        protected Normalizer $normalizer
    )
    {}

    public function getAll()
    {
        return $this->normalizer->all();
    }


    public function getById($id)
    {
        return $this->normalizer->find($id);
    }

    public function getByChannelLink($channelLink)
    {
        return $this->normalizer->where('channel_link_id', $channelLink->id)->first();
    }

}