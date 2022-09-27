{{-- Страница мероприятий --}}

@extends('template.main')

@section('meta-title')Мероприятия@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => 'Мероприятия'])
    <div class="container py-5">
        @include('modules.events', ['archive' => true])
    </div>
@endsection