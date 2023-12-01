<?php

namespace App\Repositories;

use App\Models\NewsRo;

class NewsRoRepository
{
    public function __construct(
        protected NewsRo $newsRo
    )
    {
        $this->newsRo = $newsRo;
    }

    public function getAll()
    {
        return $this->newsRo->all();
    }

    public function getById($id)
    {
        return $this->newsRo->find($id);
    }

}