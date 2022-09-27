@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Новый пользователь', 'title_nav' => 'Пользователи', 'title_nav_route' => 'admin.users'])
    </div>
    @include('admin.modules.admin_users_edit')
@endsection