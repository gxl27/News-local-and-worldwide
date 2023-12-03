<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelLink extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function normalizer()
    {
        return $this->hasOne(Normalizer::class);
    }

}
