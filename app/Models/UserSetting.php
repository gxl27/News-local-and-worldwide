<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;
    protected $casts = [
        'channel_links' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function getChannelLinksAttribute($value)
    {
        return json_decode($value);
    }

    public function setChannelLinksAttribute($value)
    {
        $this->attributes['channel_links'] = json_encode($value);
    }
}
