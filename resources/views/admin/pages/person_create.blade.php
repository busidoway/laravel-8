@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Добавление сотрудника', 'title_nav' => 'Сотрудники', 'title_nav_route' => 'admin.persons'])
    </div>
    @include('admin.modules.admin_person_edit')
@endsection