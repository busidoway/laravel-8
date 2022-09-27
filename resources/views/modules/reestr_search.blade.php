<section class="filters mb-6 mt-3">
    <div class="container">
        <!-- Реестр -->
        <div class="r-filter">
            
            <div class="tab-content" id="filter-tabs-content">
                <div class="tab-pane fade show active px-4 py-3" id="tab-qualifying-content" role="tabpanel" aria-labelledby="tab-qualifying">                        
                    <form name="arrFilter_form" action="{{ route('reestr') }}" method="get" class="mt-2 form-inline global-filter">
                        @csrf
                        <div class="row no-gutters mb-2">
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1" name="snum" placeholder="Номер аттестата" value="@isset($reestr_search){{ $reestr_search->snum }}@endisset">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1" name="sname" value="@isset($reestr_search){{ $reestr_search->sname }}@endisset" placeholder="ФИО">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1" name="sregion" value="@isset($reestr_search){{ $reestr_search->sregion }}@endisset" placeholder="Регион">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1" name="scity" value="@isset($reestr_search){{ $reestr_search->scity }}@endisset" placeholder="Город">
                            </div>
                            <div class="col-md-6 col-lg-3 px-1">
                                <input type="text" class="form-control m-1 datepicker-here" name="sdate_start" id="sdate_start" value="@isset($reestr_search){{ $reestr_search->sdate_start }}@endisset" autocomplete="off" placeholder="Дата выдачи аттестата">
                            </div>
                            <div class="col-md-6 col-lg-9 px-1 row align-items-center m-0 px-2">
                                Стаж от: <input type="number" class="form-control m-1" name="sstage_from" id="sstage_from" value="@isset($reestr_search){{ $reestr_search->sstage_from }}@endisset" min="0" placeholder="0" autocomplete="off" style="width:78px;">
                                до: <input type="number" class="form-control m-1" name="sstage_to" id="sstage_to" value="@isset($reestr_search){{ $reestr_search->sstage_to }}@endisset" placeholder="0" min="0" autocomplete="off" style="width:78px;">
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col px-1">
                                <input type="submit" class="btn btn-white ml-1" name="set_filter" value="Найти">
                            </div>
                            <div class="col px-1">
                                <a href="{{ route('reestr') }}" class="btn btn-white">Сбросить</a>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
        
    </div>
</section>