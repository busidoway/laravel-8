@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Редактирование', 'title_nav' => 'Мероприятия', 'title_nav_route' => 'admin.events'])
    </div>
    @include('admin.modules.admin_event_edit')
@endsection