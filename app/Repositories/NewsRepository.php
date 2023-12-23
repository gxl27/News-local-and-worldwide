<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\Channel;
use App\Models\ChannelLink;
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

    public function getPublicAll()
    {
        return $this->news::with('newsRo')->with('newsIt')->with('newsFr')->with('newsDe')->with('newsEs')->with('newsPt')->with('newsEn')->get();
    }

    public function getAll()
    {
        return $this->news->all();
    }

    public function getAllByChannelLink(ChannelLink $channelLink)
    {
        return $this->news->where('channel_link', $channelLink)->get();
    }

    public function getAllByChannelLinkWithTranslation(ChannelLink $channelLink, string $originalLanguage, array $languages=[])
    {
        $newsWithTranslation = $this->news->where('channel_link_id', $channelLink->id);
        foreach ($languages as $language) {
            if ($originalLanguage === $language) {
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

    public function deleteAllByChannel(Channel $channel)
    {
        News::whereHas('channelLink', function ($query) use ($channel) {
            $query->where('channel_id', $channel->id);
        })->delete();
    }

    public function delete($id)
    {
        return $this->news->find($id)->delete();
    }



}