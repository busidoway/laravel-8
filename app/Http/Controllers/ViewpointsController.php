<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viewpoint;
use App\Models\Person;
use App\Models\ViewpointPerson;
use Validator;
use Illuminate\Support\Facades\DB;

class ViewpointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewpoints = Viewpoint::orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.viewpoints', ['viewpoints' => $viewpoints]);
    }

    public function all()
    {
        $viewpoints = DB::table('viewpoints')
                        ->select('viewpoints.*', 'people.name', 'people.position', 'people.img')
                        ->join('viewpoint_people', 'viewpoints.id', '=', 'viewpoint_people.viewpoint_id')
                        ->join('people', 'people.id', '=', 'viewpoint_people.people_id')
                        ->orderBy('date', 'desc')
                        ->paginate(12);

        return view('pages.viewpoint', ['viewpoints' => $viewpoints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $persons = Person::all();

        return view('admin.pages.viewpoint_create', ['persons' => $persons]);
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
                "date" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $date = date("Y-m-d", strtotime($request->date));

        $viewpoint = Viewpoint::create([
            "title" => $request->title,
            "date" => $date,
            "short" => $request->short,
            "text" => $request->text
        ]);

        if($request->person){
            $viewpoint_person = ViewpointPerson::create([
                "viewpoint_id" => $viewpoint->id,
                "people_id" => $request->person
            ]);
        }else{
            $viewpoint_person = '';
        }

        return redirect()->route('viewpoints.edit', $viewpoint->id)->with(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viewpoint = DB::table('viewpoints')
                        ->select('viewpoints.*', 'people.name', 'people.position', 'people.img')
                        ->join('viewpoint_people', 'viewpoints.id', '=', 'viewpoint_people.viewpoint_id')
                        ->join('people', 'people.id', '=', 'viewpoint_people.people_id')
                        ->where('viewpoints.id', $id)
                        ->first();

        return view('pages.inner.viewpoint_inner', ['viewpoint' => $viewpoint]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $viewpoints = Viewpoint::find($id);
        $viewpoint_person = ViewpointPerson::where('viewpoint_id', $viewpoints->id)->first();
        $persons = Person::all();

        return view('admin.pages.viewpoint_edit', ['viewpoints' => $viewpoints, 'persons' => $persons, 'viewpoint_person' => $viewpoint_person]);
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
                "date" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $viewpoints = Viewpoint::find($id);

        $date = date("Y-m-d", strtotime($request->date));

        $viewpoints->title = $request->title;
        $viewpoints->date = $date;
        $viewpoints->short = $request->short;
        $viewpoints->text = $request->text;

        if($viewpoints->isDirty()){
            $viewpoints->save();
        }

        if($request->person){
            $viewpoint_person = ViewpointPerson::where('viewpoint_id', $viewpoints->id)->first();
            
            if($viewpoint_person){
                $viewpoint_person->people_id = $request->person;
                if($viewpoint_person->isDirty()){
                    $viewpoint_person->save();
                }
            }else{
                $viewpoint_person_create = ViewpointPerson::create([
                    "viewpoint_id" => $viewpoints->id,
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
        $viewpoints = Viewpoint::find($id);
        if($viewpoints) {
            $viewpoints->delete();
            return redirect()->route('admin.viewpoints')->with(["status" => true]);
        }else{
            return redirect()->route('admin.viewpoints')->with(["status" => false]);
        }
    }
}
