<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card border-0 shadow components-section card-module">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($persons)){{ route('persons.update', $persons->id) }}@else{{ route('persons.store') }}@endif" enctype="multipart/form-data" method="post">
                    @csrf
                    @isset($persons) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <label for="name">Имя</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Имя" value="@isset($persons){{ $persons->name }}@endisset" required>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="position">Должность</label>
                        <div class="input-group">
                            <input name="position" id="position" class="form-control" placeholder="Должность"  value="@isset($persons){{ $persons->position }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="image">@if(isset($persons)){{ __('Загрузить фото') }} @else {{ __('Фото') }} @endif</label>
                        <div class="input-group">
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>
                    <div class="mx-0 mb-3 row">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.persons') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>