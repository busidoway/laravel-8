<div class="row">
    <div class="col-md-9">
        <div class="video-module mb-3">
            <video oncontextmenu="return false;" controls="controls" playsinline style="max-width:100%;" controlsList="nodownload" poster="@isset($video){{ $video->image }}@endisset">
                @if(isset($video->video_type))
                    @if($video->video_type == "mp4")
                    <source type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' src="@isset($video){{ $video->url }}@endisset">
                    @elseif($video->video_type == "webm")
                    <source type='video/webm; codecs="vp8, vorbis"' src="@isset($video){{ $video->url }}@endisset">
                    @elseif($video->video_type == "ogg")
                    <source type='video/ogg; codecs="theora, vorbis"' src="@isset($video){{ $video->url }}@endisset">
                    @endif
                @else
                    <source src="@isset($video){{ $video->url }}@endisset">
                @endif
            </video>
        </div>
        <!-- @isset($video->text)<div class="my-3 video-text">{{ $video->text }}</div>@endisset -->
    </div>
    <div class="col-md-3">
        @isset($video->date)<div class="mb-3"><b>{{ getDateRus($video->date) }}</b><hr></div>@endisset
        @isset($video->lector)<div class="mb-3"><b>Лектор:</b> {{ $video->lector }}</div>@endisset
        @isset($video->org)<div class="mb-3"><b>Организатор:</b> {{ $video->org }}</div>@endisset
        @isset($video->time)<div class="mb-3"><b>Время:</b> {{ $video->time }}</div>@endisset
    </div>
</div>