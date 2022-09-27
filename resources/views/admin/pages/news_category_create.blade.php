@extends('admin.template.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        @includeif('admin.includes.nav_page', ['title' => 'Добавление Категории', 'title_nav' => 'Категории новостей', 'title_nav_route' => 'admin.news_category'])
    </div>
    @include('admin.modules.admin_news_category_edit')
@endsection