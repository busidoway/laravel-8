@php
$curr_date = date('Y-m-d H:i:s');
$news_arr = DB::table('news')
        ->select('news.*', 'news_categories.id as cat_id', 'news_categories.title as cat_title')
        ->join('news_category_joins', 'news.id', '=', 'news_category_joins.news_id')
        ->join('news_categories', 'news_categories.id', '=', 'news_category_joins.news_category_id')
        ->whereDate('date', '<=', $curr_date)
        ->where('news_categories.id', $news_cat)
        ->orderBy('date', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(12);
@endphp
@php if(isset($count)) $news_arr = $news_arr->take($count) @endphp
<div class="news_content news_filter row">
    @foreach($news_arr as $n)
    <div class="news-item news-item--standart mb-5 col-12 col-lg-4 order-0 show" data-item="news">
        <div class="card h-100">
            <div class="card-body">
                <p>
                    <a href="{{ route('news_inner', ['id' => $n->id]) }}" class="link">
                        <span class="h5 card-title mb-2 fw-bold">{{ $n->title }}</span>
                    </a>
                </p>
                <p class="card-text text-justify">{!! $n->short !!}</p>
            </div>
            <div class="card-footer">
                <hr class="mt-0">
                <span class="">{{ getDateRus($n->date) }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>
@empty($count)
<div class="paginator pagination-container d-flex justify-content-center mt-2">
    {{ $news_arr->onEachSide(1)->links() }}
</div>
@endempty