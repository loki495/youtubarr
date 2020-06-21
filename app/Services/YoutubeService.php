<?php

namespace App\Services;

use Symfony\Component\Process\Process;
use App\Video;

class YoutubeService {

    public $test = 0;

    public function search($id) {
        $cmd = 'youtube-dl';

        //$full_cmd = implode(' ',[$cmd,'-j',$id,'--write-info-json']);
        //dd($full_cmd);
        $process = new Process([$cmd,'-j',$id,'--write-info-json']);
        $process->run();
        $json = json_decode($process->getOutput());

        if (!$json) {
            return null;
        }

        $video = new Video();

        $video->title = $json->title;
        $video->youtube_id = $json->id;
        $video->youtube_uploader = [
            'channel_id' => $json->channel_id,
            'channel_url' => $json->channel_url,
            'id' => $json->uploader_id,
            'name' => $json->uploader,
            'url' => $json->uploader_url,
        ];

        $video->status = '';
        $video->description = $json->description;
        $video->published_on = substr($json->upload_date,0,4).'-'.substr($json->upload_date,4,2).'-'.substr($json->upload_date,6);
        $video->image = array_pop($json->thumbnails)->url;
        $video->thumb = array_pop($json->thumbnails)->url;
        $video->duration = $json->duration;
        $video->formats = $json->formats;

        return collect()->add($video);
    }

    public function download($id, $format) {
        $cmd = 'youtube-dl';

        $full_cmd = implode(' ',[$cmd,$simulate,'--write-info-json','--no-part',$id,'-f',$format]);
        dd($full_cmd);
        $process = new Process([$cmd,$simulate,'--write-info-json','--no-part',$id,'-f',$format]);
        $process->run();
        $output = $process->getOutput();

        return $output;

    }

    public function get_channel_logo($content){
        if (strpos($content,'http') === 0) {
            $content = file_get_contents($content);
        }

        $start = '<img class="appbar-nav-avatar" src="';
        $end = '" title="';

        $r = explode($start, $content);

        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
}
