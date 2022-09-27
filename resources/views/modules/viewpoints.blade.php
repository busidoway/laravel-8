<div class="news mb-5">
    <div class="news_content news_filter row">
        @foreach($viewpoints as $viewpoint)
            <div class="news-item news-item--standart mb-5 col-12 col-lg-4 order-0 show">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="media-avatar mr-4 rounded-circle" style="background-image:url(/storage/{{ $viewpoint->img }})"></span>
                            <div class="">
                                <div class="mb-2"><strong>{{ $viewpoint->name }}</strong></div>
                                <div class="news_person__position">{{ $viewpoint->position }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>
                            <a href="{{ route('viewpoint_inner', $viewpoint->id) }}" class="link">
                                <span class="h5 card-title mb-2 fw-bold">{!! $viewpoint->title !!}</span>
                            </a>
                        </p>
                        <p class="card-text text-justify">{!! $viewpoint->short !!}</p>
                    </div>
                    <div class="px-4"><a href="{{ route('viewpoint_inner', $viewpoint->id) }}" class="text-secondary py-3"><strong>Читать полностью</strong></a></div>
                    <div class="card-footer">
                        <hr class="mt-0">
                        <span>{{ getDateRus($viewpoint->date) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="paginator pagination-container d-flex justify-content-center mt-2">
        {{ $viewpoints->onEachSide(1)->links() }}
    </div>
</div>