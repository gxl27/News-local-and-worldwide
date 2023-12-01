<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsEn extends Model
{
    use HasFactory;

    protected $table = 'news_en';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
