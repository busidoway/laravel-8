<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
// use Illuminate\Pagination\Paginator;
// use App\Models\News;
use App\Models\NewsCategory;
use Carbon\Carbon;

class NewsCategoryComposer
{
    public function compose(View $view)
    {
        $news_category = NewsCategory::all();

        return $view->with('news_category', $news_category);
    }
}