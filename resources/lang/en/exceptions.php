<?php

return [
    '400' => [
        'message' => 'Api call for RSS news failed',
        'description' => 'Api call failed or timeout'
    ],
    '1000' => [
        'message' => 'Normalizer channel cannot be found',
        'description' => 'The channel does not have a normalizer, verify the relationship between Normalize model and ChannelLink model'
    ],

    '1002' => [
        'message' => 'Normalizer mapper cannot be generated',
        'description' => 'The normalizer mapper cannot be generated, normalizer data missing or corrupt'
    ],

  
    '1005' => [
        'message' => 'Normalizer failed, cannot find the xmls tags',
        'description' => 'The normalizer fields cannot be found in the xmls tags'
    ],
    '1010' => [
        'message' => 'Normalizer failed, cannot map correctly the xmls',
        'description' => 'The normalizer couldn\'t map correctly the xmls tags with the News model'
    ]
];