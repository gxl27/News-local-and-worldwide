<?php

namespace App\Repositories;

use App\Models\NewsEn;

class NewsEnRepository
{
    public function __construct(
        protected NewsEn $newsEn
    )
    {
        $this->newsEn = $newsEn;
    }

    public function getAll()
    {
        return $this->newsEn->all();
    }

    public function getById($id)
    {
        return $this->newsEn->find($id);
    }



}