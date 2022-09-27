@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Загрузка видео', 'title_nav' => 'Загрузка видео'])
    </div>
    @include('admin.modules.admin_video_load')
@endsection