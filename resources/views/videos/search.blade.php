@extends('layouts.base')

@section('content')

    <div>
        <h3>Results</h3>
        <div class="video-list table">
            @if ($videos)
            <div class="video-list-item video-list-header">
                <div class="thumb"></div>
                <div class="title">Title</div>
                <div class="description">Description</div>
                <div class="published-on">Published On</div>
                @if ($videos[0]->formats)
                    <div class="download"></div>
                @endif
            </div>

            @each('components.video-list-item', $videos, 'video')

            @else
                No videos found
            @endif

        </div>
    </div>

<style>

.video-list.table,
.video-list.table > div {
    display: flex;
    flex-wrap: wrap;
}
.video-list-header {
    background: #ddd;
    color: #282828;
}
.video-list-item {
    width: 100%;
}
.video-list-item > div {
    padding: 20px;
}
.video-list-item .thumb {
    width: 20%;
}
.video-list-item .title {
    font-size: inherit;
    width: 20%;
}
.video-list-item .description {
    min-width: 20%;
    flex-grow: 1;
}
.video-list-item .published-on {
    width: 20%;
    text-align: center;
}
.video-list-item .download {
    width: 20%;
}
.video-list-item img {
    max-width: 100%;
}

</style>
@endsection
