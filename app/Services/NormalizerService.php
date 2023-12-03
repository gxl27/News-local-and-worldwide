<?php

namespace App\Services;

use App\Models\Normalizer;
use App\Repositories\NormalizerRepository;
use App\Enums\NormalizerList;
use App\Normalizer\NewsNormalizer;

class NormalizerService
{
    const NORMALIZER_FIELDS = [
        'root_normalizer',
        'title_normalizer',
        'description_normalizer',
        'link_normalizer',
        'image_normalizer',
        'pub_date_normalizer',
        'guid_normalizer'
    ];

    public function __construct(
        protected NormalizerRepository $normalizerRepository,
        protected NewsNormalizer $newsNormalizer
    )
    {}

    public function getAll()
    {
        return $this->normalizerRepository->getAll();
    }

    public function getById($id)
    {
        return $this->normalizerRepository->getById($id);
    }

    public function getByChannelLink($channelLink)
    {
        return $this->normalizerRepository->getByChannelLink($channelLink);
    }

    public function addMapper(Normalizer $normalizer): array|bool
    {
        $mapper = [];

        $normalizerArray = $normalizer->toArray();
        foreach ($normalizerArray as $key => $value) {
            if (is_null($value) || !$value) {
                if (!($key == 'image_normalizer')) {
                    return false;
                }
            }

            if (in_array($key, SELF::NORMALIZER_FIELDS)) {
                $explode = explode(',', $value);
                if (sizeof($explode) > 1) {
                    $mapper[$key] = $explode;
                } else {
                    $mapper[$key] = $value;
                }
            }
        }
     
        return $mapper;
    }

    public function getItems($normalizer, $xml) 
    {
        if (!is_array($normalizer) || !is_array($xml)) {
            return false;
        }
        $items = [];
        $currentLevel = $xml;

        foreach ($normalizer['root_normalizer'] as $key) {
            // Check if the key exists in the current level
           
            if (isset($currentLevel[$key])) {
                // if ($key == 'item') {
                //     dd('xx');
                // }
                // Copy the value to items
                $items = $currentLevel[$key];
                // Move to the next level
                $currentLevel = $currentLevel[$key];
            } else {
                // Break the loop if the key is not found
                return false;
            }
        }
        $normalizedData = [];
        // in case there are leaf elements as an array (ex 'image' it's in 'encoded' array)
        $this->newsNormalizer->setNormalizer($normalizer);
        for ($i = 0 ; $i < sizeof($items) ; $i++) {
            $normalizedData[$i] = $this->newsNormalizer->normalize($items[$i]);
           
        }
    

        return $normalizedData;
    }


}