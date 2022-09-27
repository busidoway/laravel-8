<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card card-module border-0 shadow components-section">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($reestr)){{ route('reestr.update', $reestr->id) }}@else{{ route('reestr.store') }}@endif" method="post">
                    @csrf
                    @isset($reestr) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <label for="num_doc">№ аттестата</label>
                        <div class="input-group">
                            <input type="text" name="num_doc" id="num_doc" class="form-control" placeholder="№ аттестата" value="@isset($reestr){{ $reestr->num_doc }}@endisset" required>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="name">Ф.И.О.</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ф.И.О." value="@isset($reestr){{ $reestr->name }}@endisset" required>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="city">Город</label>
                        <div class="input-group">
                            <input type="text" name="city" id="city" class="form-control" placeholder="Город" value="@isset($reestr){{ $reestr->city }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="region">Регион</label>
                        <div class="input-group">
                            <input type="text" name="region" id="region" class="form-control" placeholder="Регион" value="@isset($reestr){{ $reestr->region }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                            <label for="date_start">Дата выдачи аттестата:</label>
                            <div class="input-group">
                                <input type="text" name="date_start" id="date_start" class="form-control datepicker-here" autocomplete="off" placeholder="Дата" value="@isset($reestr){{ Carbon\Carbon::parse($reestr->date_start)->format('d.m.Y') }}@endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div> 
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                            <label for="date_end">Дата окончания аттестата:</label>
                            <div class="input-group">
                                <input type="text" name="date_end" id="date_end" class="form-control datepicker-here" autocomplete="off" placeholder="Дата" value="@isset($reestr){{ Carbon\Carbon::parse($reestr->date_end)->format('d.m.Y') }}@endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div> 
                    </div>
                    <div class="row mb-4 mx-0">
                        <div class="col-md-4">
                            <label for="date_doc">Первичная дата выдачи:</label>
                            <div class="input-group">
                                <input type="text" name="date_doc" id="date_doc" class="form-control datepicker-here" autocomplete="off" placeholder="Дата" value="@isset($reestr){{ Carbon\Carbon::parse($reestr->date_doc)->format('d.m.Y') }}@endisset" >
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div> 
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="organization">Организация</label>
                        <div class="input-group">
                            <input name="organization" id="organization" class="form-control" placeholder="Организация"  value="@isset($reestr){{ $reestr->organization }}@endisset">
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.reestr') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>