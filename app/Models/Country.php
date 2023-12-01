<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function userSettings()
    {
        return $this->hasMany(UserSetting::class);
    }

}
