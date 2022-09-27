<div class="card card-body border-0 shadow">
    @if(session('status'))
    <div class="py-2 mb-4 fs-5 text-success">Данные успешно загружены!</div>
    @endif
    <div>
        <form action="{{ route('admin.reestr_org_upload') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-5 col-xl-4">
                <label for="file">{{ __('Загрузить файл (.xlsx)') }}</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <div class="mb-5">
                <input type="checkbox" name="check" id="check" class="form-check-input me-2">
                <label class="form-check-label" for="check">{{ __('Очистить таблицу реестра') }}</label>
                <div class="text-danger ms-4 ps-1" style="font-size:14px;">{{ __('Внимание: если данный параметр включен, вся таблица реестра будет очищена и загрузятся новые данные из выбранного файла.') }}
                <br>{{ __('Если параметр отключен, то к существующим записям реестра добавятся данные из выбранного файла.') }}</div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success text-white">{{ __('Загрузить') }}</button>
                <a href="{{ route('admin.reestr_org_load') }}" class="btn btn-gray-500 text-white ms-2">Отмена</a>
            </div>
        </form>
    </div>
</div>