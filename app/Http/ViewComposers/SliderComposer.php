<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
// use Illuminate\Pagination\Paginator;
use App\Models\Slider;
use Carbon\Carbon;

class SliderComposer
{
    public function compose(View $view)
    {
        $curr_date = date('Y-m-d');

        $slider = Slider::where('date', '<=', $curr_date)->orWhere('date', NULL)->orderBy('id', 'desc')->get();

        return $view->with('slider', $slider);
    }
}