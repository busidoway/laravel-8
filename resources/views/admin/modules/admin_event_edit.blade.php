<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card card-module border-0 shadow components-section">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($events)){{ route('events.update', $events->id) }}@else{{ route('events.store') }}@endif" method="post">
                    @csrf
                    @isset($events) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <label for="title">Заголовок</label>
                        <div class="input-group">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Заголовок" value="@isset($events){{ $events->title }}@endisset" required>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                            <label for="date_public">Дата</label>
                            <div class="input-group px-0">
                                <input type="text" name="date_public" id="date_public" class="form-control datepicker-here" data-timepicker="true" autocomplete="off" placeholder="Дата" required value="@isset($events){{ Carbon\Carbon::parse($events->date_public)->format('d.m.Y H:i:s') }}@endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div> 
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="time">Время</label>
                        <div class="input-group">
                            <input name="time" id="time" class="form-control" placeholder="Время"  value="@isset($events){{ $events->time }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="cat">Категория</label>
                        <div class="input-group">
                            <input name="cat" id="cat" class="form-control" placeholder="Категория" value="@isset($events){{ $events->cat }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="price">Цена</label>
                        <div class="input-group">
                            <textarea name="price" id="price" class="form-control" rows="1" placeholder="Цена">@isset($events){{ $events->price }}@endisset</textarea> 
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="person">Ведущий</label>
                        <div class="col-md-4 input-group">
                            <select class="form-select" name="person" id="person" aria-label="select">
                                <option value="">-- Выбрать ведущего --</option>
                                @foreach($persons as $person)
                                    <option value="{{ $person->id }}" @if(isset($event_person) && $event_person->people_id == $person->id){{ __('selected') }}@endif>{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="text">Краткий текст</label>
                        <div class="">
                            <textarea name="short" id="short" class="form-control tinymce-editor" rows="14" placeholder="Краткий текст">@isset($events){{ $events->short }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="text">Подробный текст</label>
                        <div class="">
                            <textarea name="text" id="text" class="form-control tinymce-editor" rows="20" placeholder="Подробный текст">@isset($events){{ $events->text }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.events') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>