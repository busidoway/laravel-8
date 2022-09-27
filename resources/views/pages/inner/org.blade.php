{{-- Внутренняя страница организации --}}

@extends('template.main')

@section('meta-title'){{ __('Федеральная палата налоговых консультантов') }}@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => 'Реестр образовательных организаций'])
    <div class="container py-5">
        <div class="ipr ipr-org py-5 person">
            <div class="ipr-org-block mb-3">
                @if(isset($org))
                <div class="row m-0">
                    <div class="ipr-org-block__header person__header text-center bg-gradient p-2 fw-bold">Информация</div>
                    @if($expire == true)
                    <div class="ipr-org-block__content person__message-expire ipr-org-block__content_size py-2 text-danger text-center fw-bold border border-danger mb-0 mt-3">
						Срок аккредитации истек
					</div>
                    @endif
                    <div class="row person__name-title py-2 px-5 fs-4 mt-2 fw-bold">Образовательная организация</div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Название организации:</div>
                        <div class="col-8 ipr-org-block__note">{{ $org->name_org }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">№ свидетельства об аккредитации:</div>
                        <div class="col-8 ipr-org-block__note">{{ $org->num_cert }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Город:</div>
                        <div class="col-8 ipr-org-block__note">{{ $org->city }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Регион:</div>
                        <div class="col-8 ipr-org-block__note">{{ $org->region }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row py-3">
                        <div class="col-4 ipr-org-block__title">Начало аккредитации:</div>
                        <div class="col-8 ipr-org-block__note">{{ Carbon\Carbon::parse($org->date_start)->format('d.m.Y') }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Окончание аккредитации:</div>
                        <div class="col-8 ipr-org-block__note">{{ Carbon\Carbon::parse($org->date_end)->format('d.m.Y') }}</div>
                    </div>

                    <div class="row person__name-title py-2 px-5 fs-4 mt-5 fw-bold">Перечень аккредитованных программ</div>
                    @if (isset($program))
                        @foreach ($program as $prog)
                            <div class="">{{ $prog }}</div>
                        @endforeach
                    @endif

                    <div class="row person__name-title py-2 px-5 fs-4 mt-5 fw-bold">Контакты</div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Менеджер:</div>
                        <div class="col-8 ipr-org-block__note">{{ $org->manager }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Веб-сайт:</div>
                        <div class="col-8 ipr-org-block__note"><a href="{{ $org->website }}">{{ $org->website }}</a></div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Телефон:</div>
                        <div class="col-8 ipr-org-block__note"><a href="tel:{{ $org->phone }}">{{ $org->phone }}</a></div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Адрес:</div>
                        <div class="col-8 ipr-org-block__note">{{ $org->address }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">E-mail:</div>
                        <div class="col-8 ipr-org-block__note"><a href="mailto:{{ $org->email }}">{{ $org->email }}</a></div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Руководитель:</div>
                        <div class="col-8 ipr-org-block__note">{{ $org->boss }}</div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button class="btn btn-white" onclick="window.history.back()">Назад</button>
                    </div>
                </div>
                @else
                <div class="text-danger">Информация не найдена</div>
                @endif
            </div>
        </div>
    </div>
@endsection