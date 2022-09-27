<style>
    .user-video__list * {
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }
</style>
<div class="row">
    <div class="col-12 mb-4">
        <div class="card card-module border-0 shadow components-section">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($video)){{ route('video.update', $video->id) }}@else{{ route('video.store') }}@endif" enctype="multipart/form-data" method="post">
                    @csrf
                    @isset($video) @method('PUT') @endisset
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4 mx-0">
                                <label for="title">Тема</label>
                                <div class="input-group">
                                    <textarea type="text" name="title" id="title" class="form-control" placeholder="Тема" rows="1" required>@isset($video){{ $video->title }}@endisset</textarea>
                                </div>
                            </div>
                            <div class="row mb-4 mx-0">
                                <div class="col-md-4">
                                    <label for="date_start">Дата:</label>
                                    <div class="input-group">
                                        <input type="text" name="date" id="date" class="form-control datepicker-here" autocomplete="off" placeholder="Дата" value="@isset($video){{ Carbon\Carbon::parse($video->date)->format('d.m.Y') }}@endisset" required>
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                </div> 
                            </div>
                            <div class="row mb-4 mx-0">
                                <label for="title">Лектор</label>
                                <div class="input-group">
                                    <input type="text" name="lector" id="lector" class="form-control" placeholder="Лектор" value="@isset($video){{ $video->lector }}@endisset">
                                </div>
                            </div>
                            <div class="row mb-4 mx-0">
                                <label for="title">Организатор</label>
                                <div class="input-group">
                                    <input type="text" name="org" id="org" class="form-control" placeholder="Организатор" value="@isset($video){{ $video->org }}@endisset">
                                </div>
                            </div>
                            <div class="row mb-4 mx-0">
                                <label for="title">Время</label>
                                <div class="input-group">
                                    <input type="text" name="time" id="time" class="form-control" placeholder="Время" value="@isset($video){{ $video->time }}@endisset">
                                </div>
                            </div>
                            <div class="row mb-4 mx-0">
                                <label for="url">URL</label>
                                <div class="input-group">
                                    <textarea type="text" name="url" id="url" class="form-control" placeholder="URL" rows="1" required>@isset($video){{ $video->url }}@endisset</textarea>
                                </div>
                            </div>
                            <div class="row mb-4 mx-0">
                                <label for="news_category">Формат видео</label>
                                <div class="col-md-4 input-group">
                                    <select class="form-select" name="video_type" id="video_type" aria-label="select">
                                        <option value="">-- Выбрать тип видео --</option>
                                        <option value="mp4" @isset($video) @if($video->video_type == 'mp4'){{ __('selected') }}@endif @endisset>mp4</option>
                                        <option value="webm" @isset($video)@if($video->video_type == 'webm'){{ __('selected') }}@endif @endisset>webm</option>
                                        <option value="ogg" @isset($video) @if($video->video_type == 'ogg'){{ __('selected') }}@endif @endisset>ogg</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4 mx-0">
                                <label for="image">@if(isset($video)){{ __('Загрузить превью видео') }} @else {{ __('Превью видео') }} @endif</label>
                                <div class="input-group">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div id="app_video">
                                <user-video @if(isset($video))v-bind:id='{{ $video->id }}'@endif></user-video>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.video') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>