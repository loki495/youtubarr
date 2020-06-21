<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $fillable = [
        'name',
        'channel_id',
        'about',
        'thumb',
        'url',
    ];

    public function videos() {
        return $this->hasMany('App\Video');
    }
}
