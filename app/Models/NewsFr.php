<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsFr extends Model
{
    use HasFactory;

    protected $table = 'news_fr';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
