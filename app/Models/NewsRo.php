<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsRo extends Model
{
    use HasFactory;

    protected $table = 'news_ro';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
