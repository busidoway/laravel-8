@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Новое видео', 'title_nav' => 'Видео', 'title_nav_route' => 'admin.video'])
    </div>
    @include('admin.modules.admin_video_edit', ['users' => $users])
@endsection