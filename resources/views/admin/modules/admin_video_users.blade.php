<div class="row">
    <div class="col-8 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    @isset($video) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <textarea type="text" name="title" class="form-control" placeholder="Заголовок" style="height:2rem" required>@isset($video){{ $video->title }}@endisset</textarea>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <button type="submit" class="btn btn-success text-white">Сохранить</button>
                        <a href="{{ route('admin.video') }}" class="btn btn-gray-500 text-white ms-2">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>