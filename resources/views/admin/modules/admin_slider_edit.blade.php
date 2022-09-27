<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card border-0 shadow components-section card-module">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($slider)){{ route('slider.update', $slider->id) }}@else{{ route('slider.store') }}@endif" enctype="multipart/form-data" method="post">
                    @csrf
                    @isset($slider) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <label for="title">Заголовок</label>
                        <div class="input-group">
                            <textarea name="title" id="title" class="form-control" rows="1" placeholder="Заголовок" required>@isset($slider){{ $slider->title }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                        <label for="date">Дата (публикации на сайте)</label>
                            <div class="input-group input-group__slider-date">
                                <input type="text" name="date" id="date" class="form-control datepicker-here" autocomplete="off" onclick="" placeholder="Дата" value="@isset($slider) @isset($slider->date){{ Carbon\Carbon::parse($slider->date)->format('d.m.Y') }}@endisset @endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <a href="javascript:;" class="btn-group-text btn-clear ms-3" onclick="clearInput(this)" title="Очистить"><i class="fas fa-eraser"></i></a>
                            </div>
                        </div> 
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="text1">Текст 1</label>
                        <div>
                            <textarea name="text1" id="text1" class="form-control tinymce-editor" rows="15" placeholder="Текст">@isset($slider){{ $slider->text1 }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="text2">Текст 2</label>
                        <div>
                            <textarea name="text2" id="text2" class="form-control tinymce-editor" rows="15" placeholder="Текст">@isset($slider){{ $slider->text2 }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="text3">Текст 3</label>
                        <div>
                            <textarea name="text3" id="text3" class="form-control tinymce-editor" rows="15" placeholder="Текст">@isset($slider){{ $slider->text3 }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="image">@if(isset($slider)){{ __('Загрузить изображение') }} @else {{ __('Изображение') }} @endif</label>
                        <div class="input-group">
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="url">URL</label>
                        <div class="input-group">
                            <input type="text" name="url" id="url" class="form-control" placeholder="URL" value="@isset($slider){{ $slider->url }}@endisset">
                        </div>
                    </div>
                    <div class="mx-0 mb-3 row">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.slider') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function clearInput(e){
        let parent = e.closest('div');
        let inp = parent.querySelectorAll('input[type=text]');

        for(let i=0; i < inp.length; i++){
            inp[i].value = "";
        }
    }
</script>