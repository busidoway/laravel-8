{{-- Страница новостей --}}

@extends('template.main')

@section('meta-title')Налоговый дайджест@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => 'Налоговый дайджест'])
    <div id="wrapper">
        <div class="news container mb-5 mt-5">
            <p>Наши эксперты ежедневно анализируют огромный массив налоговых новостей и событий, в режиме нон-стоп проводят обзор изменений законодательства, отслеживают налоговые споры, судебные решения и тенденции судебной практики, позиции Минфина и ФНС России и комментируют самые значимые вопросы налогового правоприменения.</p>
            <p>В Налоговом дайджесте представлено все, что по-настоящему заслуживает внимания. Мы отбираем для вас самое важное.</p>
            @include('modules.news', ['news_cat' => 1])
        </div>
    </div>
@endsection