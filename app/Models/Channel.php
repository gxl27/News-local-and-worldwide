<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function channelLinks()
    {
        return $this->hasMany(ChannelLink::class);
    }

}
