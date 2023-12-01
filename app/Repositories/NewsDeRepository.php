<?php

namespace App\Repositories;

use App\Models\NewsDe;

class NewsDeRepository
{
    public function __construct(
        protected NewsDe $newsDe
    )
    {
        $this->newsDe = $newsDe;
    }

    public function getAll()
    {
        return $this->newsDe->all();
    }

    public function getById($id)
    {
        return $this->newsDe->find($id);
    }



}