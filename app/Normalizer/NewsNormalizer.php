<?php

namespace App\Normalizer;

use App\Contracts\NormalizeContract;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Formula;

class NewsNormalizer implements NormalizeContract{

    protected array $normalizer;
    protected int $channelId;
    public function normalize(array $data): array|null
    {
        $newsData = [];

        if (
            !array_key_exists($this->normalizer['title_normalizer'], $data) ||
            !array_key_exists($this->normalizer['description_normalizer'], $data)
        ) 
        {
            return null;
        }
        if (is_array($this->normalizer['title_normalizer'])) {
            $newsData['title'] = $this->getLeaf($this->normalizer['title_normalizer'], $data);
        } else {
            $newsData['title'] = $data[$this->normalizer['title_normalizer']];
        }
        if (strlen($newsData['title']) > 255) {
            // get only first 255 characters
            $newsData['title'] = substr($newsData['title'], 0, 255);
        }
      
        if (is_array($this->normalizer['description_normalizer'])) {
            $newsData['description'] = $this->getLeaf($this->normalizer['description_normalizer'], $data);
        } else {
           
            $newsData['description'] = $data[$this->normalizer['description_normalizer']] 
                ? $data[$this->normalizer['description_normalizer']] 
                : $newsData['title'];
        }
       
        if (is_array($this->normalizer['link_normalizer'])) {
            $newsData['link'] = $this->getLeaf($this->normalizer['link_normalizer'], $data);
        } else {
            $newsData['link'] = $data[$this->normalizer['link_normalizer']];
        }
        if (strlen($newsData['link']) > 255) {
            $newsData['link'] = '-';
        }

        if (is_array($this->normalizer['image_normalizer'])) {
            $newsData['image'] = $this->getLeaf($this->normalizer['image_normalizer'], $data);
        } else {
            $newsData['image'] = $data[$this->normalizer['image_normalizer']];
        }

        if (is_array($this->normalizer['pub_date_normalizer'])) {
            $newsData['pubDate'] = $this->getLeaf($this->normalizer['pub_date_normalizer'], $data);
        } else {
            $newsData['pubDate'] = $data[$this->normalizer['pub_date_normalizer']];
        }

        if (is_array($this->normalizer['guid_normalizer'])) {
            $newsData['guid'] = $this->getLeaf($this->normalizer['guid_normalizer'], $data);
        } else {
            $newsData['guid'] = $data[$this->normalizer['guid_normalizer']];
        }

       
        return $newsData;
    }

    public function setNormalizer(array $data, $channelId): self
    {
        $this->normalizer = $data;
        $this->channelId = $channelId;

        return $this;
    }

    private function getLeaf($normalizer , array $data): string|bool 
    {
        $items = [];
        $currentLevel = $data;
        
        foreach ($normalizer as $key) {
            // Check if the key exists in the current level
            // if ($key == 'url') {
            //     dd($currentLevel);
            // }
            if (isset($currentLevel[$key])) {
          
                // Copy the value to items
                $items = $currentLevel[$key];
                // Move to the next level
                $currentLevel = $currentLevel[$key];

            } else {
                // Break the loop if the key is not found
                return false;
            }
        }
    
        return true;
    }


}