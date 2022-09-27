@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Добавление позиции в реестр', 'title_nav' => 'Реестр', 'title_nav_route' => 'admin.reestr_org'])
    </div>
    @include('admin.modules.admin_reestr_org_edit')
@endsection