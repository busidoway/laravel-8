@php 
if(isset($archive)) $events_data = $events['events_archive']; else $events_data = $events['events']; 
date_default_timezone_set("Europe/Moscow");
$curr_date = date('Y-m-d H:i:s');
@endphp
<div class="calendar-dates events-page-container events-page">
    <div class="row mb-3 filter-items">
        @foreach($events_data as $event)
            <div class="col-12 col-sm-12 col-md-6 сol-lg-4 col-xl-4 filter-new mb-5">
                <div class="card h-100">
                    <div class="card-header">
                        <span class="">{{ $event->cat }}</span>
                    </div>
                    <div class="card-body d-flex justify-content-between flex-column">
                        <div class="card-body-header d-flex justify-content-between flex-column h-100">
                            <div class="header-link" title="{!! $event->title !!}">
                                <div class="h5 card-title mb-3 fw-bold">{!! $event->title !!}</div>
                            </div>
                            @isset($event->short)<div class="card-body-short">{!! $event->short !!}</div>@endisset
                            <div class="card-body-date">
                                <div class="text-danger mb-4">
                                    {!! $event->price !!}
                                </div>
                                <div class="media align-items-center event-date" data-date="{{ getDateRus($event->date_public) }}">
                                    <i class="icon icon-calendar icon-4x mr-4"></i>
                                    <div class="media-body">
                                        <p class="my-0">{{ getDateRus($event->date_public) }}</p>
                                        <p class="my-0">{{ getDayRus($event->date_public) }}</p>
                                        <p class="my-0">{!! $event->time !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media align-items-center mt-4 mb-4 pt-3" style="border-top:2px solid #d9d9d9;">
                            <span class="media-avatar mr-4 rounded-circle" style="background-image: url('/storage/{{ $event->img }}')">
                            </span>
                            <div class="media-body">
                                <h6 class="h6 fw-bold">{{ $event->name }}</h6>
                            </div>
                        </div>                                                                                            
                    </div>
                    @if($event->date_public >= $curr_date)
                    <div class="card-footer d-flex justify-content-between mb-2">
                        <a href="#" class="btn btn-primary btn-modal" data-recaptcha-id="recaptcha_event" data-bs-toggle="modal" data-bs-target="#formEventModal">Записаться</a>                        
                        @if($event->text != '' && $event->text != 'NULL')
                        <a href="{{ route('event_inner', ['id' => $event->id]) }}" class="btn btn-white">Подробнее</a>
                        @endif
                    </div>
                    @endif
                    @if($event->date_public < $curr_date)
                    <div class="card-footer d-flex @if($event->text != '' && $event->text != 'NULL')justify-content-between @else justify-content-end @endif mb-2">
                        @if($event->text != '' && $event->text != 'NULL')
                        <a href="{{ route('event_inner', ['id' => $event->id]) }}" class="btn btn-white">Подробнее</a>
                        @endif
                        <span class="btn btn-gray">Завершен</span>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @isset($archive)
    <div class="paginator pagination-container d-flex justify-content-center mt-2">
        {{ $events_data->onEachSide(1)->links() }}
    </div>
    @endisset
        @include('modules.events_modal')
</div>