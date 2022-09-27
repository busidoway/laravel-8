<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Person;
use App\Models\EventPerson;
use Validator;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.events', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $persons = Person::all();

        return view('admin.pages.event_create', ['persons' => $persons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => ["required"],
                "date_public" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $date_public = date("Y-m-d H:i:s", strtotime($request->date_public));

        $event = Event::create([
            "title" => $request->title,
            "cat" => $request->cat,
            "price" => $request->price,
            "date_public" => $date_public,
            "time" => $request->time,
            "short" => $request->short,
            "text" => $request->text
        ]);

        if($request->person){
            $event_person = EventPerson::create([
                "event_id" => $event->id,
                "people_id" => $request->person
            ]);
        }

        return redirect()->route('events.edit', $event->id)->with(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        return view('pages.inner.event_inner', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $events = Event::find($id);
        $event_person = EventPerson::where('event_id', $events->id)->first();
        $persons = Person::all();

        return view('admin.pages.event_edit', ['events' => $events, 'persons' => $persons, 'event_person' => $event_person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => ["required"],
                "date_public" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $events = Event::find($id);

        $date_public = date("Y-m-d H:i:s", strtotime($request->date_public));

        $events->title = $request->title;
        $events->cat = $request->cat;
        $events->price = $request->price;
        $events->date_public = $date_public;
        $events->time = $request->time;
        $events->short = $request->short;
        $events->text = $request->text;

        if($events->isDirty()){
            $events->save();
        }

        if($request->person){
            $event_person = EventPerson::where('event_id', $events->id)->first();
            
            if($event_person){
                $event_person->people_id = $request->person;
                if($event_person->isDirty()){
                    $event_person->save();
                }
            }else{
                $event_person_create = EventPerson::create([
                    "event_id" => $events->id,
                    "people_id" => $request->person
                ]);
            }
            
        }

        return redirect()->back()->with(['status' => true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events = Event::find($id);
        if($events) {
            $events->delete();
            return redirect()->route('admin.events')->with(["status" => true]);
        }else{
            return redirect()->route('admin.events')->with(["status" => false]);
        }
    }
}
