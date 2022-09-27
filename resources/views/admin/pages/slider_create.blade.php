@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Новый слайдер', 'title_nav' => 'Слайдер', 'title_nav_route' => 'admin.slider'])
    </div>
    @include('admin.modules.admin_slider_edit')
@endsection