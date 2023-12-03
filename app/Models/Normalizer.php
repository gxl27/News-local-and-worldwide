<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Normalizer extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public $timestamps = false;

    //channelLink
    public function channelLink()
    {
        return $this->belongsTo(ChannelLink::class);
    }
    
}
