<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public $fillable = [
        'playlist_id',
        'name'
    ];

    public function videos() {
        return $this->hasMany('App\Video');
    }

    public function channel() {
        return $this->belongsToOne('App\Channel');
    }
}
