<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPt extends Model
{
    use HasFactory;

    protected $table = 'news_pt';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
