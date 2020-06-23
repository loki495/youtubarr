<div class="video-list-item">

    @foreach ($columns as $col => $type)
        <div class="col {{ $col }}">
        @if ($type == 'text')
            {{ $video->$col }}
        @elseif ($type == 'image')
            <img src="{{ $video->thumb }}" />
            @if ($col == 'thumb')
                <br/>
                {{ $video->extra->channel_name }}
        @elseif ($type == 'humantime')
            {{ human_time($video->$col) }}
        @elseif ($type == 'time')
            {{ date("H:i", strtotime($video->$col)) }}
        @elseif ($type == 'timesec')
            {{ date("H:i:s", strtotime($video->$col)) }}
        @elseif ($type == 'date')
            {{ date("m/d/Y", strtotime($video->$col)) }}
        @elseif ($type == 'datetime')
            {{ date("m/d/Y H:i", strtotime($video->$col)) }}
        @elseif ($type == 'datetimesec')
            {{ date("m/d/Y H:i:s", strtotime($video->$col)) }}
        @endif
        </div>
    @endforeach

    @if ($show_download_links)
        <div class="download">
            <form action="{{ route('videos.download') }}" method="POST">
                @csrf
                <input type="hidden" name="youtube_id" value="{{ $video->youtube_id}}">
                <button class="button">Download</button>
            </form>
        </div>
    @endif
</div>
