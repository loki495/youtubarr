@extends('layouts.base')

@section('content')
    <div>
        <h3>All Videos</h3>
        <div class="video-list table">
            <div class="video-list-item video-list-header">
                <div class="thumb"></div>
                <div class="title">Title</div>
                <div class="description">Description</div>
                <div class="description">Duration</div>
                <div class="published-on">Published On</div>
                <div class="published-on">Status</div>
            </div>

            @forelse ($videos as $video)
                <x-video-list-item :video="$video" :columns="[ 'thumb'=>'image', 'title'=>'text', 'description'=>'text',  'duration' => 'humantime', 'published_on'=>'datetime','status'=>'text' ]" />
            @empty
                No videos found
            @endforelse

        </div>
    </div>
@endsection
