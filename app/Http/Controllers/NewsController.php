<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsCategoryJoin;
use Validator;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $news = News::orderBy('id', 'desc')->paginate(10);

        $news = DB::table('news')
                    ->select('news.*', 'news_categories.title as cat_title')
                    ->join('news_category_joins', 'news.id', '=', 'news_category_joins.news_id')
                    ->join('news_categories', 'news_categories.id', '=', 'news_category_joins.news_category_id')
                    ->orderBy('id', 'desc')
                    ->paginate(10);

        return view('admin.pages.news', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news_category = NewsCategory::all();

        return view('admin.pages.news_create', ['news_category' => $news_category]);
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

        $news = News::create([
            "title" => $request->title,
            "date" => $date,
            "short" => $request->short,
            "text" => $request->text
        ]);

        if($request->news_category){
            $news_category_join = NewsCategoryJoin::create([
                "news_id" => $news->id,
                "news_category_id" => $request->news_category
            ]);
        }

        return redirect()->route('news.edit', $news->id)->with(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        $news_category_join = NewsCategoryJoin::where('news_id', $news->id)->first();
        $news_category = NewsCategory::all();

        if($id == 268) return redirect()->route('forum_06_2022');

        return view('pages.inner.news_inner', ['news' => $news, 'news_category' => $news_category, 'news_category_join' => $news_category_join]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $news_category_join = NewsCategoryJoin::where('news_id', $news->id)->first();
        $news_category = NewsCategory::all();

        return view('admin.pages.news_edit', ['news' => $news, 'news_category' => $news_category, 'news_category_join' => $news_category_join]);
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

        $news = News::find($id);

        $date = date("Y-m-d", strtotime($request->date));

        $news->title = $request->title;
        $news->date = $date;
        $news->short = $request->short;
        $news->text = $request->text;

        if($news->isDirty()){
            $news->save();
        }

        if($request->news_category){
            $news_category_join = NewsCategoryJoin::where('news_id', $news->id)->first();
            
            if($news_category_join){
                $news_category_join->news_category_id = $request->news_category;
                if($news_category_join->isDirty()){
                    $news_category_join->save();
                }
            }else{
                $news_category_join_create = NewsCategoryJoin::create([
                    "news_id" => $news->id,
                    "news_category_id" => $request->news_category
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
        $news = News::find($id);
        if($news) {
            $news->delete();
            return redirect()->route('admin.news')->with(["status" => true]);
        }else{
            return redirect()->route('admin.news')->with(["status" => false]);
        }
    }
}
