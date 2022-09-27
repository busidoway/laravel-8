{{-- Внутренняя страница консультанта --}}

@extends('template.main')

@section('meta-title'){{ __('') }}@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => 'Заголовок'])
    <div class="container py-5">
        <div class="ipr ipr-org py-5 person">
            <div class="ipr-org-block mb-3">
                @if(isset($person))
                <div class="row m-0">
                    <div class="ipr-org-block__header person__header text-center bg-gradient p-2 fw-bold">Информация</div>
                    @if($expire == true)
                    <div class="ipr-org-block__content person__message-expire ipr-org-block__content_size py-2 text-danger text-center fw-bold border border-danger mb-0 mt-3">
						Срок действия аттестата истек
					</div>
                    @endif
                    <div class="row person__name-title py-2 px-5 fs-4 mt-2 fw-bold">{{ $person->name }}</div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Номер аттестата :</div>
                        <div class="col-8 ipr-org-block__note">{{ $person->num_doc }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Город :</div>
                        <div class="col-8 ipr-org-block__note">{{ $person->city }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Регион :</div>
                        <div class="col-8 ipr-org-block__note">{{ $person->region }}</div>
                    </div>
					<div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Стаж налогового консультанта (лет) :</div>
                        <div class="col-8 ipr-org-block__note">@if($stage != 0){{ $stage }} @else {{ __("менее года") }} @endif</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row py-3">
                        <div class="col-4 ipr-org-block__title">Дата выдачи аттестата :</div>
                        <div class="col-8 ipr-org-block__note">{{ Carbon\Carbon::parse($person->date_start)->format('d.m.Y') }}</div>
                    </div>
                    <div class="ipr-org-block__content ipr-org-block__content_size row">
                        <div class="col-4 ipr-org-block__title">Окончание действия аттестата :</div>
                        <div class="col-8 ipr-org-block__note">{{ Carbon\Carbon::parse($person->date_end)->format('d.m.Y') }}</div>
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