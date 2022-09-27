@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Редактирование', 'title_nav' => 'Видео', 'title_nav_route' => 'admin.video'])
    </div>
    @include('admin.modules.admin_video_edit', ['video' => $video, 'users' => $users, 'user_videos' => $user_videos])
@endsection