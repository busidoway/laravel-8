{{-- Внутренняя страница новостей --}}

@extends('template.main')

@section('meta-title'){{ $news->title }}@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => $news->title])
    <div class="container py-5">
        <div class="article__subtext mb-3 fw-bold">{{ getDateRus($news->date) }}</div>
        <div class="py-3 text-justify">{!! $news->text !!}</div>
        <div class="d-flex justify-content-center mt-4 mb-4">
            <button class="btn btn-white" onclick="window.history.back()">Назад</button>
        </div>
    </div>
@endsection