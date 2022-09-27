@extends('template.main')

@section('meta-title')Заголовок@endsection

@section('content')
<div id="wrapper">
    <main role="main">
        <div class="container_mod">
            
            @include('modules.slider')

            @include('modules.block_links')

	    </div>
	<!-- .container_mod -->
    </main>

    <div class="container">
        <div class="row" id="events">
        </div>
        @include('modules.events')
        <div class="d-flex justify-content-center mb-6">
            <a href="{{ route('events') }}" class="btn btn-white">Все мероприятия</a>
        </div>
    </div>

    <div class="news container py-3 mb-5">
        @isset($news_category)
        <ul class="nav nav-pills mb-3 justify-content-center px-3 gap-3 news-category" id="news_category_tab" role="tablist">
        @foreach($news_category as $cat)
            <li class="nav-item news-category__item" role="presentation">
                <button class="nav-link px-3 py-1 h1 news-category__link @if($loop->first) active @endif" id="news_category{{ $cat->id }}" data-bs-toggle="pill" data-bs-target="#news_tab{{ $cat->id }}" type="button" role="tab" aria-controls="news_tab{{ $cat->id }}" aria-selected="true">{{ $cat->title }}</button>
            </li>
        @endforeach
        </ul>
        <div class="tab-content" id="news_tab_content">
        @endisset
        @foreach($news_category as $cat)
        <div class="tab-pane fade @if($loop->first) show active @endif" role="tabpanel" aria-labelledby="news_category{{ $cat->id }}" id="news_tab{{ $cat->id }}">

            @include('modules.news', ['count' => 9, 'news_cat' => $cat->id])

            <div class="d-flex justify-content-center mt-4 mb-4">
                <a href="/{{ $cat->url }}" class="btn btn-white btn-all-news">Все новости</a>
            </div>
        </div>
        @endforeach
        @isset($news_category)
        </div>
        @endisset
    </div>

    @include('blocks.video_home')

</div>
@endsection