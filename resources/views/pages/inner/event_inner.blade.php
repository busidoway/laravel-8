{{-- Внутренняя страница мероприятия --}}

@extends('template.main')

@section('meta-title'){{ $event->title }}@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => $event->title])
    <div class="container py-5">
        <div class="py-3 text-justify">{!! $event->text !!}</div>
        <div class="d-flex justify-content-center mt-4 mb-4">
            <button class="btn btn-white" onclick="window.history.back()">Назад</button>
        </div>
    </div>
@endsection