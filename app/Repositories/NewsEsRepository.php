<?php

namespace App\Repositories;

use App\Models\NewsEs;

class NewsEsRepository
{
    public function __construct(
        protected NewsEs $newsEs
    )
    {
        $this->newsEs = $newsEs;
    }

    public function getAll()
    {
        return $this->newsEs->all();
    }

    public function getById($id)
    {
        return $this->newsEs->find($id);
    }



}