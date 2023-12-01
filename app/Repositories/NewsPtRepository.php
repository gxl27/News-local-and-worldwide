<?php

namespace App\Repositories;

use App\Models\NewsPt;

class NewsPtRepository
{
    public function __construct(
        protected NewsPt $newsPt
    )
    {
        $this->newsPt = $newsPt;
    }

    public function getAll()
    {
        return $this->newsPt->all();
    }

    public function getById($id)
    {
        return $this->newsPt->find($id);
    }



}