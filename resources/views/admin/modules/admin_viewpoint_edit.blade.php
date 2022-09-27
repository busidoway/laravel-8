<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card card-module border-0 shadow components-section">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($viewpoints)){{ route('viewpoints.update', $viewpoints->id) }}@else{{ route('viewpoints.store') }}@endif" method="post">
                    @csrf
                    @isset($viewpoints) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <label for="title">Заголовок</label>
                        <div class="input-group">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Заголовок" value="@isset($viewpoints){{ $viewpoints->title }}@endisset" required>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                            <label for="date">Дата</label>
                            <div class="input-group">
                                <input type="text" name="date" id="date" class="form-control datepicker-here" autocomplete="off" placeholder="Дата" required value="@isset($viewpoints){{ Carbon\Carbon::parse($viewpoints->date)->format('d.m.Y') }}@endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div> 
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                            <label for="person">Автор</label>
                            <div class="input-group">
                                <select class="form-select" name="person" id="person" aria-label="select">
                                    <option value="">-- Выбрать автора --</option>
                                    @foreach($persons as $person)
                                        <option value="{{ $person->id }}" @if(isset($viewpoint_person) && $viewpoint_person->people_id == $person->id){{ __('selected') }}@endif>{{ $person->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="short">Краткий текст</label>
                        <div>
                            <textarea name="short" id="short" class="form-control tinymce-editor" rows="12" placeholder="Краткий текст">@isset($viewpoints){{ $viewpoints->short }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="text">Подробный текст</label>
                        <div>
                            <textarea name="text" id="text" class="form-control tinymce-editor" rows="20" placeholder="Подробный текст">@isset($viewpoints){{ $viewpoints->text }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.viewpoints') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>