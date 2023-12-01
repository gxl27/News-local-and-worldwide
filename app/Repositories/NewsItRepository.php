<?php

namespace App\Repositories;

use App\Models\NewsIt;

class NewsItRepository
{
    public function __construct(
        protected NewsIt $newsIt
    )
    {
        $this->newsIt = $newsIt;
    }

    public function getAll()
    {
        return $this->newsIt->all();
    }

    public function getById($id)
    {
        return $this->newsIt->find($id);
    }



}