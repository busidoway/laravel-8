@extends('template.main')

@section('meta-title')Видео@endsection

@auth

@section('content')
    
    @if($access)

    @includeif('includes.page_title', ['page_title' => $video->title])
    
    <div class="video-container container mb-5 mt-5">
        @include('modules.video', ['video' => $video])
    </div>

    @else

    <div class="video-container container mb-5 mt-5">
        <div class="text-danger h3 py-5 mb-4 text-center">Видео недоступно</div>
        <div class="d-flex justify-content-center"><button class="btn btn-primary btn-modal-video" data-recaptcha-id="recaptcha_video" data-title="{{ $video->title }}" data-bs-toggle="modal" data-bs-target="#videoOrderModal">Купить</button></div>
    </div>

    @include('modules.video_modal')

    @endif

@endsection

@endauth