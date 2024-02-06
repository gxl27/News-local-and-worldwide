<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelGroup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;
    
    protected $casts = [
        'channel_links' => 'array',
    ];

    public function getChannelLinksAttribute($value)
    {
        return json_decode($value);
    }

    public function setChannelLinksAttribute($value)
    {
        $this->attributes['channel_links'] = json_encode($value);
    }
}
