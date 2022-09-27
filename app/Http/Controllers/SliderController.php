<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::orderBy('id', 'desc')->paginate(10);;

        return view('admin.pages.slider', ['slider' => $slider]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.slider_create');
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
                "title" => ["required"]
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

        if(isset($request->date))
            $date = date("Y-m-d", strtotime($request->date));
        else
            $date = NULL;

        $slider = Slider::create([
            "title" => $request->title,
            "text1" => $request->text1,
            "text2" => $request->text2,
            "text3" => $request->text3,
            "img" => $path_img,
            "url" => $request->url,
            "date" => $date
        ]);

        return redirect()->route('slider.edit', $slider->id)->with(['status' => true]);
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
        $slider = Slider::find($id);

        return view('admin.pages.slider_edit', ['slider' => $slider]);
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
                "title" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $slider = Slider::find($id);

        if(isset($request->date))
            $date = date("Y-m-d", strtotime($request->date));
        else
            $date = NULL;

        $slider->title = $request->title;
        $slider->text1 = $request->text1;
        $slider->text2 = $request->text2;
        $slider->text3 = $request->text3;
        $slider->url = $request->url;
        $slider->date = $date;

        $img = $request->file('image');

        if($img){
            $slider->img = $img->store('images/photo', 'public');
        }

        if($slider->isDirty()){
            $slider->save();
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
        $slider = Slider::find($id);
        if($slider) {
            $slider->delete();
            return redirect()->route('admin.slider')->with(["status" => true]);
        }else{
            return redirect()->route('admin.slider')->with(["status" => false]);
        }
    }
}
