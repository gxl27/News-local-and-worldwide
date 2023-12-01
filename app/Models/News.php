<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public $timestamps = false;

    //channelLink
    public function channelLink()
    {
        return $this->belongsTo(ChannelLink::class);
    }
    
    public function newsEn()
    {
        return $this->hasOne(NewsEn::class);
    }

    public function newsEs()
    {
        return $this->hasOne(NewsEs::class);
    }

    public function newsDe()
    {
        return $this->hasOne(NewsDe::class);
    }

    public function newsFr()
    {
        return $this->hasOne(NewsFr::class);
    }

    public function newsPt()
    {
        return $this->hasOne(NewsPt::class);
    }

    public function newsIt()
    {
        return $this->hasOne(NewsIt::class);
    }

    public function newsRo()
    {
        return $this->hasOne(NewsRo::class);
    }
}
