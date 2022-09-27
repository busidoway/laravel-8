@php
    if(isset($route_path))
        $url_path = getUrlPath($route_path);
    else
        $url_path = '';
@endphp
<div class="reestr-detail">
    <div class="container">
        <div class="row mb-4">
            <!--div class="col-12 col-sm-4 align-self-center">Записей:</div-->
            <div class="col-12 col-sm-7 col-md-5 col-lg-4 col-xl-4 ml-sm-auto">
                <div class="count-list d-flex justify-content-sm-end align-items-center">
                    <div class="count-list-text mr-2">
                        Показать по:
                    </div>
                    <div class="count-list-rusult">
                        <div class="dropdown">
                            <a class="btn btn-white dropdown-toggle count-list-drop" type="button" id="dropdownCountButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(isset($count)){{ $count }}@else{{ __('20') }}@endif результатов
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownCountButton">
                                <a class="dropdown-item" href="?count=5{{ $url_path }}">5</a>
                                <a class="dropdown-item" href="?count=10{{ $url_path }}">10</a>
                                <a class="dropdown-item" href="?count=20{{ $url_path }}">20</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table reestr-nalogovyh-konsultantov table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="item-name col-md-4" scope="col">Название организации</th>
                                <th class="item-city col-md-2" scope="col">Город</th>
                                <th class="item-region col-md-2" scope="col">Регион</th>
                                <th class="item-code col-md-2" scope="col">№ свидетельства<br>об аккредитации</th>
                                <th class="item-sert-start" scope="col">Начало аккредитации</th>
                                <th class="item-sert-stop" scope="col">Окончание аккредитации</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reestr as $r)
                                <tr class="item-tr" onclick="window.location.href='{{ route("org", $r->num_cert) }}'; return false">
                                    <td class="item-td item-name">{{ $r->name_org }}</td>
                                    <td class="item-td item-city">{{ $r->city }}</td>
                                    <td class="item-td item-region">{{ $r->region }}</td>
                                    <td class="item-td item-code">{{ $r->num_cert }}</td>
                                    <td class="item-td item-sert-start">{{ Carbon\Carbon::parse($r->date_start)->format('d.m.Y') }}</td>
									<td class="item-td item-sert-stop">{{ Carbon\Carbon::parse($r->date_end)->format('d.m.Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="paginator card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-center mt-3">
            {{ $reestr->onEachSide(1)->links() }}
        </div>
    </div>
</div>