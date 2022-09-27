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
                                <a class="dropdown-item" href="?count=20{{ $url_path }}">20</a>
                                <a class="dropdown-item" href="?count=50{{ $url_path }}">50</a>
                                <a class="dropdown-item" href="?count=100{{ $url_path }}">100</a>
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
                                <th class="item-code" scope="col">№ <br>аттестата</th>
                                <th class="item-name" scope="col">ФИО</th>
                                <th class="item-city" scope="col">Город</th>
                                <th class="item-region" scope="col">Регион</th>
                                <th class="item-stage" scope="col" width="130px">Стаж налогового<br>консультанта<br>(лет)</th>
                                <th class="item-sert-start" scope="col">Дата выдачи<br>аттестата</th>
                                <th class="item-sert-stop" scope="col">Окончание<br>действия<br>аттестата</th>
                                <!--th class="item-edu-org" scope="col">Образовательная <br>организация</th-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reestr as $r)
                                @php 
                                    $stage = getStage($r->date_doc);
                                @endphp
                                <tr class="item-tr" onclick="window.location.href='{{ route("person", $r->url_value) }}'; return false">
                                    <td class="item-td item-code">{{ $r->num_doc }}</td>
                                    <td class="item-td item-name">{{ $r->name }}</td>
                                    <td class="item-td item-city">{{ $r->city }}</td>
                                    <td class="item-td item-region">{{ $r->region }}</td>
									<td class="item-td item-region">@if($stage != 0){{ $stage }} @else {{ __("менее года") }} @endif</td>
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