<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use App\Models\UserVideo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Pagination\Paginator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video::orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.video', ['video' => $video]);
    }

    public function indexUpload()
    {
        return view('admin.pages.video_load');
    }

    public function uploadVideo(Request $request)
    {
        $inputFileType = 'Xlsx';

        $inputFileName = $request->file('file');

        $reader = IOFactory::createReader($inputFileType);

        $reader->setReadEmptyCells(false);

        $spreadsheet = $reader->load($inputFileName);

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        if(isset($request->check)){
            Video::truncate();
        }

        foreach($sheetData as $data){
            if(!empty($data)){
                $date = date("Y-m-d", strtotime($data['A']));

                $video = Video::create([
                    'date' => $date,
                    'title' => $data['B'],
                    'lector' => $data['C'],
                    'org' => $data['D'],
                    'time' => $data['E'],
                    'cat' => $data['F'],
                    'url' => $data['G']
                ]);
            }
        }

        return redirect()->route('admin.video_load')->with(['status' => true]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();

        return view('admin.pages.video_create', ['users' => $users]);
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
                "url" => ["required"],
                "date" => ["required"]
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

        $video = Video::create([
            "title" => $request->title,
            "date" => $request->date,
            "lector" => $request->lector,
            "org" => $request->org,
            "time" => $request->time,
            "url" => $request->url,
            "video_type" => $request->video_type,
            "image" => $path_img
        ]);

        if(isset($request->users)){
            $users_data = $request->users;
            foreach($users_data as $data){
                $user_video = UserVideo::create([
                    "user_id" => $data,
                    "video_id" => $video->id
                ]);
            }
        }

        return redirect()->route('video.edit', $video->id)->with(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);

        $user_id = Auth::id();

        $user_videos = DB::table('users')
                    ->select('users.*')
                    ->join('user_videos', 'users.id', '=', 'user_videos.user_id')
                    ->where('user_videos.video_id', $video->id)
                    ->where('users.id', $user_id)
                    ->first();

        $access = false;

        if(isset($user_videos) && !empty($user_videos)) $access = true;

        $user_roles = DB::table('users')
                    ->select('users.*', 'roles.level')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->where('users.id', $user_id)
                    ->where('roles.level', 1)
                    ->first();

        if(isset($user_roles) && !empty($user_roles)) $access = true;

        // foreach($user_videos as $uv){
        //     if($uv->id == $user_id){
        //         $access = true;
        //     }
        //     if($uv->level == 1){
        //         $access = true;
        //     }
        // }

        return view('pages.video', ['video' => $video, 'access' => $access]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        // $users = User::all();

        $user_videos = DB::table('users')
                    ->select('users.*')
                    ->join('user_videos', 'users.id', '=', 'user_videos.user_id')
                    ->where('user_videos.video_id', $video->id)
                    ->get();

        $arr_users = array();

        foreach($user_videos as $user){
            $arr_users[] = $user->id;
        }

        // return $arr_users;

        $users = DB::table('users')
                    ->whereNotIn('id', $arr_users)
                    ->get();

        return view('admin.pages.video_edit', ['video' => $video, 'users' => $users, 'user_videos' => $user_videos]);
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
                "url" => ["required"],
                "date" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $video = Video::find($id);

        $video->title = $request->title;
        $video->date = $request->date;
        $video->lector = $request->lector;
        $video->org = $request->org;
        $video->time = $request->time;
        $video->url = $request->url;
        $video->video_type = $request->video_type;

        $img = $request->file('image');

        if($img){
            $video->image = $img->store('images/photo', 'public');
        }

        // return $request->users_video;

        if($video->isDirty()){
            $video->save();
        }

        // $user_video = UserVideo::where('video_id', $video->id);

        if(isset($request->users_video)){

            $users_data = $request->users_video;
            $users_data_keys = [];

            foreach($users_data as $key=>$data){
                // $user_videos = UserVideo::where('video_id', $video->id)->where('user_id', $data)->first();
                $user_videos = UserVideo::where('id', $data)->first();
                if($user_videos){
                    $user_videos->user_id = $key;
                    $user_videos->video_id = $video->id;
                    if($user_videos->isDirty()){
                        $user_videos->save();
                    }
                    $users_data_keys[] = $data;
                }else{
                    $user_video = UserVideo::create([
                        "user_id" => $key,
                        "video_id" => $video->id
                    ]);
                    $users_data_keys[] = $user_video->id;
                }
                
            }

            // return $users_data_keys;

        }

        if(!empty($users_data_keys)){
            $user_video_empty = UserVideo::where('video_id', $video->id)
                                         ->whereNotIn('id', $users_data_keys)
                                         ->get();
            foreach($user_video_empty as $uv){
                $user_video_delete = UserVideo::find($uv->id);
                if($user_video_delete) $user_video_delete->delete();
            }
        }


        return redirect()->back()->with(['status' => true]);
    }

    public function getUsers()
    {
        $users = User::all();

        return ['users' => $users];
    }

    public function getUserVideo(Video $video)
    {

        $user_videos = DB::table('users')
                    ->select('users.*', 'user_videos.id as uv_id')
                    ->join('user_videos', 'users.id', '=', 'user_videos.user_id')
                    ->where('user_videos.video_id', $video->id)
                    ->get();

        $arr_users = array();

        foreach($user_videos as $user){
            $arr_users[] = $user->id;
        }

        $users = DB::table('users')
                    ->whereNotIn('id', $arr_users)
                    ->get();

        return ['users' => $users, 'video' => $video, 'user_videos' => $user_videos];
    }

    public function storeUserVideo(Request $request, Video $video)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => ["required"],
                "url" => ["required"],
                "date" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        if(isset($request->users)){
            $users_data = $request->users;
            foreach($users_data as $data){
                $user_video = UserVideo::create([
                    "user_id" => $data,
                    "video_id" => $video->id
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);
        if($video) {
            $video->delete();
            return redirect()->route('admin.video')->with(["status" => true]);
        }else{
            return redirect()->route('admin.video')->with(["status" => false]);
        }
    }
}
