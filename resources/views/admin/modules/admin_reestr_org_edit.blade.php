<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card card-module border-0 shadow components-section">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($reestr)){{ route('reestr_org.update', $reestr->id) }}@else{{ route('reestr_org.store') }}@endif" method="post">
                    @csrf
                    @isset($reestr) @method('PUT') @endisset
                    <div class="mb-4 text-uppercase h5 ps-2 fw-bolder">Данные организации</div>
                    <div class="row mb-4 mx-0">
                        <label for="num_doc">№ свидетельства об аккредитации <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="num_cert" id="num_cert" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->num_cert }}@endisset" required>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="name">Название организации <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="name_org" id="name_org" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->name_org }}@endisset" required>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="city">Город</label>
                        <div class="input-group">
                            <input type="text" name="city" id="city" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->city }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="region">Регион</label>
                        <div class="input-group">
                            <input type="text" name="region" id="region" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->region }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                            <label for="date_start">Начало аккредитации:</label>
                            <div class="input-group">
                                <input type="text" name="date_start" id="date_start" class="form-control datepicker-here" autocomplete="off" placeholder="" value="@isset($reestr){{ Carbon\Carbon::parse($reestr->date_start)->format('d.m.Y') }}@endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div> 
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                            <label for="date_end">Окончание аккредитации:</label>
                            <div class="input-group">
                                <input type="text" name="date_end" id="date_end" class="form-control datepicker-here" autocomplete="off" placeholder="" value="@isset($reestr){{ Carbon\Carbon::parse($reestr->date_end)->format('d.m.Y') }}@endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div> 
                    </div>
                    <div class="mb-4 mt-5 text-uppercase h5 ps-2 fw-bolder">Программы</div>
                    <div class="row mb-4 mx-0">
                        <label for="num_doc" class="mb-4">Перечень программ</label>
                        <div id="app_program_list">
                            <program-list></program-list>
                        </div>
                    </div>
                    <div class="mb-4 mt-5 text-uppercase h5 ps-2 fw-bolder">Контакты</div>
                    <div class="row mb-4 mx-0">
                        <label for="num_doc">Менеджер</label>
                        <div class="input-group">
                            <input type="text" name="manager" id="manager" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->manager }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="num_doc">Веб-сайт</label>
                        <div class="input-group">
                            <input type="text" name="website" id="website" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->website }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="num_doc">Телефон</label>
                        <div class="input-group">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->phone }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="num_doc">Адрес</label>
                        <div class="input-group">
                            <input type="text" name="address" id="address" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->address }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="num_doc">E-mail</label>
                        <div class="input-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->email }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="num_doc">Руководитель</label>
                        <div class="input-group">
                            <input type="text" name="boss" id="boss" class="form-control" placeholder="" value="@isset($reestr){{ $reestr->boss }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.reestr_org') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>