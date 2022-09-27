<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card card-module border-0 shadow components-section">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($news)){{ route('news.update', $news->id) }}@else{{ route('news.store') }}@endif" method="post">
                    @csrf
                    @isset($news) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <label for="title">Заголовок</label>
                        <div class="input-group">
                            <textarea name="title" id="title" class="form-control" rows="1" placeholder="Заголовок" required>@isset($news){{ $news->title }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                        <label for="date">Дата</label>
                            <div class="input-group">
                                <input type="text" name="date" id="date" class="form-control datepicker-here" autocomplete="off" onclick="" placeholder="Дата" required value="@isset($news){{ $news->date->format('d.m.Y') }}@endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div> 
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="news_category">Категория</label>
                        <div class="col-md-4 input-group">
                            <select class="form-select" name="news_category" id="news_category" aria-label="select">
                                <option value="">-- Выбрать категорию --</option>
                                @foreach($news_category as $cat)
                                    <option value="{{ $cat->id }}" @if(isset($news_category_join) && $news_category_join->news_category_id == $cat->id){{ __('selected') }}@endif>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="short">Краткий текст</label>
                        <div>
                            <textarea name="short" id="short" class="form-control tinymce-editor" rows="15" placeholder="Краткий текст">@isset($news){{ $news->short }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="text">Подробный текст</label>
                        <div>
                            <textarea name="text" id="text" class="form-control tinymce-editor" rows="25" placeholder="Подробный текст">@isset($news){{ $news->text }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="mx-0 mb-3 row">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.news') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>