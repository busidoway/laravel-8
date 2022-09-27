<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reestr;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Validator;
use Illuminate\Support\Facades\DB;

class ReestrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reestr = Reestr::orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.reestr', ['reestr' => $reestr]);
    }

    public function all(Request $request)
    {
        // массив для поиска
        $array_search = [];
        
        // данные запроса поиска
        $snum = $request->snum;
        $sname = '%'.$request->sname.'%';
        $scity = '%'.$request->scity.'%';
        $sregion = '%'.$request->sregion.'%';
        $sstage_from = $request->sstage_from;
        $sstage_to = $request->sstage_to;

        if(!empty($request->sdate_start)) $sdate_start = date("Y-m-d", strtotime($request->sdate_start));
        if(!empty($request->sdate_end)) $sdate_end = date("Y-m-d", strtotime($request->sdate_end));

        // сортировка по стажу, формула: текущая дата минус заданное число (год) стажа
        $stage_form_val = strtotime("-".$sstage_from." year");
        $stage_date_from = date("Y-m-d", $stage_form_val);

        // здесь нужно прибавить один год, т.к. стаж при выводе округляется до целого числа в меньшую сторону
        $sstage_to = (int)$sstage_to + 1;

        $stage_to_val = strtotime("-".$sstage_to." year");
        $stage_date_to = date("Y-m-d", $stage_to_val);

        // формирование запросов для поиска по базе
        if($request->snum) array_push($array_search, ['num_doc', '=', $snum ]);
        if($request->sname) array_push($array_search, ['name', 'like', $sname]);
        if($request->scity) array_push($array_search, ['city', 'like', $scity]);
        if($request->sregion) array_push($array_search, ['region', 'like', $sregion]);
        if($request->sdate_start) array_push($array_search, ['date_start', '>=', $sdate_start]);
        if($request->sdate_end) array_push($array_search, ['date_end', '<=', $sdate_end]);
        if($request->sstage_from) array_push($array_search, ['date_doc', '<=', $stage_date_from]);
        if($request->sstage_to) array_push($array_search, ['date_doc', '>=', $stage_date_to]);

        // количество записей на странице
        $count = $request->query('count');
        $paginate = 20;
        if($count) $paginate = $count;

        // строка запроса
        $route_path = $request->except('count');

        if(!empty($array_search)){
            $reestr = DB::table('reestrs')
                    ->where($array_search)
                    ->orderBy('id')
                    ->paginate($paginate)
                    ->withQueryString();

            return view('pages.reestr', ['reestr' => $reestr, 'count' => $count, 'reestr_search' => $request, 'route_path' => $route_path]);
        }
        
        $reestr = Reestr::orderBy('id')->paginate($paginate)->withQueryString();

        return view('pages.reestr', ['reestr' => $reestr, 'count' => $count, 'route_path' => $route_path]);
    }

    public function person($id)
    {
        $person = Reestr::where('num_doc', $id)->first();
        
        $curr_date = date("d.m.Y");
        $expire = false;		
        if(strtotime($curr_date) > strtotime($person->date_end)){
            $expire = true;
        }

        $stage = getStage($person->date_doc);

        return view('pages.inner.person', ['person' => $person, 'expire' => $expire, 'stage' => $stage]);
    }

    public function redir(Request $request)
    {
        if(isset($request->person)){ 
            $person = $request->person;
            return redirect()->route('person', ["id" => $person]);
        }else{
            return abort(404);
        }
    }

    public function indexUpload()
    {
        return view('admin.pages.reestr_load');
    }

    public function uploadReestr(Request $request)
    {
        $inputFileType = 'Xlsx';

        $inputFileName = $request->file('file');

        $reader = IOFactory::createReader($inputFileType);

        $reader->setReadEmptyCells(false);

        $spreadsheet = $reader->load($inputFileName);

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        if(isset($request->check)){
            Reestr::truncate();
        }

        $url = '';

        // dd($sheetData);

        foreach($sheetData as $data){
            if(!empty($data)){
                $date_start = date("Y-m-d", strtotime($data['E']));
                $date_end = date("Y-m-d", strtotime($data['F']));
                $date_doc = date("Y-m-d", strtotime($data['G']));

                $reestr = Reestr::create([
                    'num_doc' => $data['A'],
                    'name' => $data['B'],
                    'city' => $data['C'],
                    'region' => $data['D'],
                    'date_start' => $date_end,
                    'date_end' => $date_start,
                    'date_doc' => $date_doc,
                    // 'organization' => $data['H'],
                    'url' => $url.$data['A'],
                    'url_value' => $data['A']
                ]);
            }
        }

        return redirect()->route('admin.reestr_load')->with(['status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.reestr_create');
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
                "num_doc" => ["required"],
                "name" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $date_start = date("Y-m-d", strtotime($request->date_start));
        $date_end = date("Y-m-d", strtotime($request->date_end));
        $date_doc = date("Y-m-d", strtotime($request->date_doc));

        $url = '';

        $reestr = Reestr::create([
            "num_doc" => $request->num_doc,
            "name" => $request->name,
            "city" => $request->city,
            "region" => $request->region,
            "date_start" => $date_start,
            "date_end" => $date_end,
            "date_doc" => $date_doc,
            "organization" => $request->organization,
            "url" => $url.$request->num_doc,
            "url_value" => $request->num_doc
        ]);

        return redirect()->route('reestr.edit', $reestr->id)->with(['status' => true]);
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
        $reestr = Reestr::find($id);

        return view('admin.pages.reestr_edit', ['reestr' => $reestr]);
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
                "num_doc" => ["required"],
                "name" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $reestr = Reestr::find($id);

        $date_start = date("Y-m-d", strtotime($request->date_start));
        $date_end = date("Y-m-d", strtotime($request->date_end));
        $date_doc = date("Y-m-d", strtotime($request->date_doc));

        $url = '';

        $reestr->num_doc = $request->num_doc;
        $reestr->name = $request->name;
        $reestr->city = $request->city;
        $reestr->region = $request->region;
        $reestr->date_start = $date_start;
        $reestr->date_end = $date_end;
        $reestr->date_doc = $date_doc;
        $reestr->organization = $request->organization;
        $reestr->url = $url.$request->num_doc;
        $reestr->url_value = $request->num_doc;

        if($reestr->isDirty()){
            $reestr->save();
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
        $reestr = Reestr::find($id);
        if($reestr) {
            $reestr->delete();
            return redirect()->route('admin.reestr')->with(["status" => true]);
        }else{
            return redirect()->route('admin.reestr')->with(["status" => false]);
        }
    }
}
