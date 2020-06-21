<div class="video-list-item">
    <div class="thumb"><img src="{{ $video->thumb }}" /></div>
    <div class="title">{{ $video->title }}</div>
    <div class="description">{{ $video->description }}</div>
    <div class="published-on">{{ $video->published_on}}</div>
    @if ($video->formats)
        <div class="download">
            <form action="{{ route('videos.download') }}" method="POST">
                @csrf
                <input type="hidden" name="youtube_id" value="{{ $video->youtube_id}}">
                <select name="format">
                    @foreach ($video->formats as $format)
                        <option value="{{ $format->format_id }}">{{ $format->format }} ({{ bytes_to_human($format->filesize)  }})</option>
                    @endforeach
                </select>
                <button class="button">Download</button>
            </form>
        </div>
    @endif
</div>
