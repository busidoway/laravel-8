@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Загрузка реестра организаций', 'title_nav' => 'Загрузка реестра организаций'])
    </div>
    @include('admin.modules.admin_reestr_org_load')
@endsection