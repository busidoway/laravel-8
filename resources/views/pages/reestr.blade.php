{{-- Страница реестра --}}

@extends('template.main')

@section('meta-title')Реестр@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => 'Реестр'])
    <div class="container my-5">
        <div class="gray-background text-justify">
        </div>
    </div>
    @includeif('modules.reestr_search')
    @includeif('modules.reestr')
@endsection