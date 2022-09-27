<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Pagination\Paginator;
use App\Models\News;
// use App\Models\NewsCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NewsComposer
{
    public function compose(View $view)
    {
        $curr_date = date('Y-m-d H:i:s');

        $news = DB::table('news')
                ->select('news.*', 'news_categories.id as cat_id', 'news_categories.title as cat_title')
                ->join('news_category_joins', 'news.id', '=', 'news_category_joins.news_id')
                ->join('news_categories', 'news_categories.id', '=', 'news_category_joins.news_category_id')
                ->whereDate('date', '<=', $curr_date)
                ->orderBy('date', 'desc')
                ->orderBy('id', 'desc')
                ->paginate(12);
                // ->get();

        return $view->with('news', $news);
    }
}