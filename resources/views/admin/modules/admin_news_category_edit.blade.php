<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card card-module border-0 shadow components-section">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($news_category)){{ route('news_category.update', $news_category->id) }}@else{{ route('news_category.store') }}@endif" method="post">
                    @csrf
                    @isset($news_category) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <label for="title">Заголовок</label>
                        <div class="input-group">
                            <textarea name="title" id="title" class="form-control" rows="1" placeholder="Заголовок" required>@isset($news_category){{ $news_category->title }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="title">URL</label>
                        <div class="input-group">
                            <textarea name="url" id="url" class="form-control" rows="1" placeholder="URL">@isset($news_category){{ $news_category->url }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="mx-0 mb-3 row">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.news_category') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>