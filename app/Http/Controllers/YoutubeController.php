<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\YoutubeService;
use App\Video;
use App\Channel;

class YoutubeController extends Controller
{
    public function index() {
        return view('videos.home');
    }

    public function search($keywords, YoutubeService $youtube) {
        $videos = $youtube->search($keywords);
        return view('videos.search', compact('videos'));
    }

    public function download(Request $request, YoutubeService $youtube) {
        //$output = $youtube->download($request->youtube_id, $request->format);
        //d($output);
        if (Video::where('youtube_id',$request->youtube_id)) {
            return redirect()->route('videos.home')->with('error','Video exists');
        }

        $video = $youtube->search($request->youtube_id)->first();
        if (!$video) {
            return redirect()->route('videos.home')->with('error','Video not found!');
        }

        $channel = Channel::firstOrCreate(
            [
                'channel_id' => $video->youtube_uploader['id']
            ],
            [
                'channel_id' => $video->youtube_uploader['id'],
                'name' => $video->youtube_uploader['name'],
                'url' => $video->youtube_uploader['url'] ?? $video->youtube_uploader['channel_url'],
                'thumb' => $youtube->get_channel_logo($video->youtube_uploader['url']),
            ]);

        $channel->save();

        $video->status = 'queued';

        $format_str = '';
        foreach ($video->formats as $format) {
            if ($format->format_id == $request->format) {
                $format_str = $format->format;
                $filesize = $format->filesize;
                break;
            }
        }

        $filename = '';

        $video->filesize = 0;
        $video->extra = [
            'downloaded_format' => [
                'format_code' => $request->format,
                'format' => $format_str,
                'filesize' => $filesize,
            ],
            'filename' => $filename,
            'available_formats' => $video->formats,
        ];

        $video->channel_id = $channel->id;
        $video->save();

        return redirect()->route('videos.home');
    }
}
