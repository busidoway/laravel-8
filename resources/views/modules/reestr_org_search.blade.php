<section class="filters mb-6 mt-3">
    <div class="container">
        <!-- Реестр -->
        <div class="r-filter">
            
            <div class="tab-content" id="filter-tabs-content">
                <div class="tab-pane fade show active px-4 py-3" id="tab-qualifying-content" role="tabpanel" aria-labelledby="tab-qualifying">                        
                    <form name="arrFilter_form" action="{{ route('reestr_org') }}" method="get" class="mt-2 form-inline global-filter">
                        @csrf
                        <div class="row no-gutters mb-2">
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1" name="scity" value="@isset($reestr_search){{ $reestr_search->scity }}@endisset" placeholder="Город">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1" name="sregion" value="@isset($reestr_search){{ $reestr_search->sregion }}@endisset" placeholder="Регион">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1" name="snum_cert" placeholder="Номер свидетельства" value="@isset($reestr_search){{ $reestr_search->snum_cert }}@endisset">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1" name="sname_org" value="@isset($reestr_search){{ $reestr_search->sname_org }}@endisset" placeholder="Название организации">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1 datepicker-here" name="sdate_start" id="sdate_start" value="@isset($reestr_search){{ $reestr_search->sdate_start }}@endisset" autocomplete="off" placeholder="Начало аккредитации">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1 datepicker-here" name="sdate_end" id="sdate_end" value="@isset($reestr_search){{ $reestr_search->sdate_end }}@endisset" autocomplete="off" placeholder="Окончание аккредитации">
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col px-1">
                                <input type="submit" class="btn btn-white ml-1" name="set_filter" value="Найти">
                            </div>
                            <div class="col px-1">
                                <a href="{{ route('reestr_org') }}" class="btn btn-white">Сбросить</a>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
        
    </div>
</section>