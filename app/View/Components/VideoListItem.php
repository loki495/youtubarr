<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VideoListItem extends Component
{

    public $video;
    public $columns;
    public $show_download_links;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($video,$columns,$show_download_links = false)
    {
        $this->video = $video;
        $this->columns = $columns;
        $this->show_download_links = $show_download_links;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $video = $this->video;
        $columns = $this->columns;
        $show_download_links = $this->show_download_links;

        return view('components.video-list-item',compact('video','columns','show_download_links'));
    }
}
