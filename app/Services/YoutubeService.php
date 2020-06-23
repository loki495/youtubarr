<?php

namespace App\Services;

use Symfony\Component\Process\Process;
use App\Video;

use Alaouy\Youtube\Facades\Youtube;

class YoutubeService {

    public $test = 0;

    public function search($id) {

        $collection = collect();

        $results = Youtube::search($id);

        foreach ($results as $res) {

            if (isset($res->id->videoId)) {
                // its a video
                $video_obj = Youtube::getVideoInfo($res->id->videoId,['id', 'snippet', 'contentDetails', 'player', 'statistics', 'status','recordingDetails']);

                $video = new Video();

                $video->title = $video_obj->snippet->title;
                $video->youtube_id = $video_obj->id;
                $video->extra = [
                    'channel_id' => $video_obj->snippet->channelId,
                    'channel_title' => $video_obj->snippet->channelTitle,
                    'channel_url' => 'https://www.youtube.com/channel/' . $video_obj->snippet->channelId,
                ];

                $video->status = '';
                $video->description = $video_obj->snippet->description;
                $video->published_on = $video_obj->snippet->publishedAt;
                $video->thumb = $video_obj->snippet->thumbnails->default->url;
                $video->image = $video_obj->snippet->thumbnails->high->url;
                $video->duration = $this->parseDuration($video_obj->contentDetails->duration);

                $collection->add($video);
            } else
            if (isset($res->id->channelId)) {
                d(1);
            }
        }

        /*

        $cmd = 'youtube-dl';

        //$full_cmd = implode(' ',[$cmd,'-j',$id,'--write-info-json']);
        //dd($full_cmd);
        $process = new Process([$cmd,'-j',$id,'--write-info-json']);
        $process->run();

        $output = $process->getOutput();
        $error = $process->getErrorOutput();
        d($output,$error);

        $json = json_decode($output);

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

        $collection->add($video);
         */

        return $collection;
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

    public function parseDuration($str) {
        $str = substr($str,2);

        $h_end = strpos($str,'H');
        $m_end = strpos($str,'M');

        $h = substr($str, 0, $h_end);
        $m = substr($str, $h_end + 1, $m_end - 2);
        $s = substr($str, $m_end + 1, -1);

        $str = "$h:$m:$s";
        return $str;
    }
}
