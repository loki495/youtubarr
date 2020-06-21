<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VideoListItem extends Component
{

    public $video;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $video = $this->video;
        return view('components.video-list-item',compact('video'));
    }
}
