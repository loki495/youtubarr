<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $youtube_uploader;
    public $formats;

    protected $fillable = [
        'youtube_id',
        'channel_id',
        'status',
        'title',
        'description',
        'image',
        'thumb',
        'published_on',
        'duration',
        'filesize',
        'extra',
    ];

    /*
    protected $guarded = [
        'youtube_uploader',
        'formats',
    ];
     */

    protected $casts = [
        'extra' => 'array'
    ];

    public function channel() {
        return $this->belongsToOne('App\Channel');
    }
}
