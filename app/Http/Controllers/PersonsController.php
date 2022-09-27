<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
// use Symfony\Component\HttpFoundation\File\UploadedFile;

class PersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.persons', ['persons' => $persons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.person_create');
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
                "name" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $img = $request->file('image');

        if($img){
            $path_img = $img->store('images/photo', 'public');
        }else{
            $path_img = null;
        }

        $persons = Person::create([
            "name" => $request->name,
            "position" => $request->position,
            "img" => $path_img
        ]);

        return redirect()->route('persons.edit', $persons->id)->with(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persons = Person::find($id);

        return view('admin.pages.person_edit', ['persons' => $persons]);
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
                "name" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $persons = Person::find($id);

        $persons->name = $request->name;
        $persons->position = $request->position;

        $img = $request->file('image');

        if($img){
            $persons->img = $img->store('images/photo', 'public');
        }

        if($persons->isDirty()){
            $persons->save();
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
        $persons = Person::find($id);
        if($persons) {
            $persons->delete();
            return redirect()->route('admin.persons')->with(["status" => true]);
        }else{
            return redirect()->route('admin.persons')->with(["status" => false]);
        }
    }
}
