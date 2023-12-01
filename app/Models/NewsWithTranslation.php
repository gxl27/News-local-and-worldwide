<?php

namespace App\Models;

use App\Repositories\NewsRoRepository;
use App\Repositories\NewsItRepository;
use App\Repositories\NewsFrRepository;
use App\Repositories\NewsDeRepository;
use App\Repositories\NewsEsRepository;
use App\Repositories\NewsPtRepository;
use App\Repositories\NewsEnRepository;

class NewsWithTranslation
{
    public function __construct(
        protected NewsRoRepository $newsRoRepository,
        protected NewsItRepository $newsItRepository,
        protected NewsFrRepository $newsFrRepository,
        protected NewsDeRepository $newsDeRepository,
        protected NewsEsRepository $newsEsRepository,
        protected NewsPtRepository $newsPtRepository,
        protected NewsEnRepository $newsEnRepository,
    )
    {}

    public function getAll(string $nativeLanguage): array
    {
        return [
            'ro' => $this->newsRoRepository->getAll(),
            'it' => $this->newsItRepository->getAll(),
            'fr' => $this->newsFrRepository->getAll(),
            'de' => $this->newsDeRepository->getAll(),
            'es' => $this->newsEsRepository->getAll(),
            'pt' => $this->newsPtRepository->getAll(),
            'en' => $this->newsEnRepository->getAll(),
        ];
    }

    public function getById($id)
    {
        return [
            'ro' => $this->newsRo->find($id),
            'it' => $this->newsIt->find($id),
            'fr' => $this->newsFr->find($id),
            'de' => $this->newsDe->find($id),
        ];
    }
}
