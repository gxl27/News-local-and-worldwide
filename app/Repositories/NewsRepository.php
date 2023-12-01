<?php

namespace App\Repositories;

use App\Models\ChannelLink;
use App\Models\News;
use App\Models\NewsWithTranslation;

class NewsRepository
{
    public function __construct(
        protected News $news,
        protected NewsRoRepository $newsRoRepository,
        protected NewsItRepository $newsItRepository,
        protected NewsFrRepository $newsFrRepository,
        protected NewsDeRepository $newsDeRepository,
        protected NewsEsRepository $newsEsRepository,
        protected NewsPtRepository $newsPtRepository,
        protected NewsEnRepository $newsEnRepository,
    )
    {
    }

    public function getAll()
    {
        return $this->news->all();
    }

    public function getAllByChannelLink(ChannelLink $channelLink)
    {
        return $this->news->where('channel_link', $channelLink)->get();
    }

    public function getAllByChannelLinkWithTranslation(ChannelLink $channelLink, string $defaultLanguage='En', array $languages=[])
    {
        $newsWithTranslation = $this->news->where('channel_link_id', $channelLink->id);
        foreach ($languages as $language) {
            if ($defaultLanguage === $language) {
                continue;
            }
            $relationMethod = "news" . ucfirst($language);
            // dd(method_exists($this->news, $relationMethod));
            if (method_exists($this->news, $relationMethod)) {
                $newsWithTranslation->with($relationMethod);
            }
        }
        return $newsWithTranslation->get();
    }

    public function getById($id)
    {
        return $this->news->find($id);
    }

    public function deleteAllByChannelLink(ChannelLink $channelLink)
    {
        return $this->news->where('channel_link_id', $channelLink->id)->delete();
    }

    public function delete($id)
    {
        return $this->news->find($id)->delete();
    }



}