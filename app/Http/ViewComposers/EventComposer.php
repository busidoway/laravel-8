<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Pagination\Paginator;
use App\Models\Event;
use App\Models\EventPerson;
use Illuminate\Support\Facades\DB;

class EventComposer
{
    public function compose(View $view)
    {
        $event_arr = array();
        date_default_timezone_set("Europe/Moscow");
        $curr_date = date('Y-m-d H:i:s');

        $event_arr['events'] = DB::table('events')
                                ->select('events.*', 'people.name', 'people.img')
                                ->join('event_people', 'events.id', '=', 'event_people.event_id')
                                ->join('people', 'people.id', '=', 'event_people.people_id')
                                ->where('date_public', '>=', $curr_date)
                                ->orderBy('date_public', 'asc')
                                ->get();

        $event_arr['events_archive'] = DB::table('events')
                                        ->select('events.*', 'people.name', 'people.img')
                                        ->join('event_people', 'events.id', '=', 'event_people.event_id')
                                        ->join('people', 'people.id', '=', 'event_people.people_id')
                                        // ->where('date_public', '<', $curr_date)
                                        ->orderBy('date_public', 'desc')
                                        ->paginate(12);

        return $view->with('events', $event_arr);
    }
}