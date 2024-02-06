<?php

namespace App\Services;

use App\Repositories\ChannelGroupRepository;

class ChannelGroupService
{

    public function __construct(
        protected ChannelGroupRepository $channelGroupRepository
    )
    {}

    public function getAll()
    {
        return $this->channelGroupRepository->getAll();
    }

    public function getAllActive()
    {
        return $this->channelGroupRepository->getAllActive();
    }

    public function getById($id)
    {
        return $this->channelGroupRepository->getById($id);
    }

    public function create($data)
    {
        return $this->channelGroupRepository->create($data);
    
    }

    public function update($id, $data)
    {
        return $this->channelGroupRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->channelGroupRepository->delete($id);
    }
}