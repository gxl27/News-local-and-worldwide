<?php

namespace App\Repositories;

use App\Models\NewsFr;

class NewsFrRepository
{
    public function __construct(
        protected NewsFr $newsFr
    )
    {
        $this->newsFr = $newsFr;
    }

    public function getAll()
    {
        return $this->newsFr->all();
    }

    public function getById($id)
    {
        return $this->newsFr->find($id);
    }



}