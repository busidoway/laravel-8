{{-- Внутренняя страница точки зрения --}}

@extends('template.main')

@section('meta-title'){{ $viewpoint->title }}@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => $viewpoint->title])
    <div class="container py-5">
        <div class="article__subtext mb-3 d-flex align-items-center">
            <span class="media-avatar mr-4 rounded-circle" style="background-image:url(/storage/{{ $viewpoint->img }})"></span>
            <div>
                <div class="mb-2"><strong>{{ $viewpoint->name }}</strong></div>
                <div class="news_person__position">{{ $viewpoint->position }}</div>
            </div>
        </div>
        <div class="py-3 text-justify">{!! $viewpoint->text !!}</div>
        <hr class="mt-0">
        <div class="mb-3 fw-bolder d-flex justify-content-start">{{ getDateRus($viewpoint->date) }}</div>
        <div class="d-flex justify-content-center mt-4 mb-4">
            <button class="btn btn-white" onclick="window.history.back()">Назад</button>
        </div>
    </div>
@endsection