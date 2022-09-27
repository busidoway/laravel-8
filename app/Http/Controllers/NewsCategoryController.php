<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Validator;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news_category = NewsCategory::orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.news_category', ['news_category' => $news_category]);
    }

    public function all()
    {
        $news_category = NewsCategory::all();

        return view('pages.home', ['news_category' => $news_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.news_category_create');
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

        $news_category = NewsCategory::create([
            "title" => $request->title,
            "url" => $request->url
        ]);

        return redirect()->route('news_category.edit', $news_category->id)->with(['status' => true]);
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
        $news_category = NewsCategory::find($id);

        return view('admin.pages.news_category_edit', ['news_category' => $news_category]);
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

        $news_category = NewsCategory::find($id);

        $news_category->title = $request->title;
        $news_category->url = $request->url;

        if($news_category->isDirty()){
            $news_category->save();
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
        $news_category = NewsCategory::find($id);
        if($news_category) {
            $news_category->delete();
            return redirect()->route('admin.news_category')->with(["status" => true]);
        }else{
            return redirect()->route('admin.news_category')->with(["status" => false]);
        }
    }
}
