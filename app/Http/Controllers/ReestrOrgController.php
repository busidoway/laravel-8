<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReestrOrg;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Validator;
use Illuminate\Support\Facades\DB;

class ReestrOrgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reestr = ReestrOrg::orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.reestr_org', ['reestr' => $reestr]);
    }

    public function all(Request $request)
    {
        // массив для поиска
        $array_search = [];
        
        // данные запроса поиска
        $snum = $request->snum_cert;
        $sname = '%'.$request->sname_org.'%';
        $scity = '%'.$request->scity.'%';
        $sregion = '%'.$request->sregion.'%';

        if(!empty($request->sdate_start)) $sdate_start = date("Y-m-d", strtotime($request->sdate_start));
        if(!empty($request->sdate_end)) $sdate_end = date("Y-m-d", strtotime($request->sdate_end));

        // формирование запросов для поиска по базе
        if($request->snum_cert) array_push($array_search, ['num_cert', '=', $snum ]);
        if($request->sname_org) array_push($array_search, ['name_org', 'like', $sname]);
        if($request->scity) array_push($array_search, ['city', 'like', $scity]);
        if($request->sregion) array_push($array_search, ['region', 'like', $sregion]);
        if($request->sdate_start) array_push($array_search, ['date_start', '>=', $sdate_start]);
        if($request->sdate_end) array_push($array_search, ['date_end', '<=', $sdate_end]);

        // количество записей на странице
        $count = $request->query('count');
        $paginate = 20;
        if($count) $paginate = $count;

        // строка запроса
        $route_path = $request->except('count');

        if(!empty($array_search)){
            $reestr = DB::table('reestr_orgs')
                    ->where($array_search)
                    ->orderBy('id')
                    ->paginate($paginate)
                    ->withQueryString();

            return view('pages.reestr_org', ['reestr' => $reestr, 'count' => $count, 'reestr_search' => $request, 'route_path' => $route_path]);
        }
        
        $reestr = ReestrOrg::orderBy('id')->paginate($paginate)->withQueryString();

        return view('pages.reestr_org', ['reestr' => $reestr, 'count' => $count, 'route_path' => $route_path]);
    }

    public function indexUpload()
    {
        return view('admin.pages.reestr_org_load');
    }

    public function uploadReestr(Request $request)
    {
        $inputFileType = 'Xlsx';

        // $inputFileName = './docs/reestr.xlsx';

        $inputFileName = $request->file('file');

        $reader = IOFactory::createReader($inputFileType);

        $reader->setReadEmptyCells(false);

        $spreadsheet = $reader->load($inputFileName);

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        if(isset($request->check)){
            ReestrOrg::truncate();
        }

        foreach($sheetData as $data){
            if(!empty($data)){
                $date_start = date("Y-m-d", strtotime($data['E']));
                $date_end = date("Y-m-d", strtotime($data['F']));

                if(isset($data['G'])) $manager = $data['G']; else $manager = NULL;
                if(isset($data['H'])) $website = $data['H']; else $website = NULL;
                if(isset($data['I'])) $phone = $data['I']; else $phone = NULL;
                if(isset($data['J'])) $address = $data['J']; else $address = NULL;
                if(isset($data['K'])) $email = $data['K']; else $email = NULL;
                if(isset($data['L'])) $boss = $data['L']; else $boss = NULL;

                $reestr = ReestrOrg::create([
                    'name_org' => $data['A'],
                    'num_cert' => $data['D'],
                    'city' => $data['B'],
                    'region' => $data['C'],
                    'date_start' => $date_end,
                    'date_end' => $date_start,
                    'manager' => $manager,
                    'website' => $website,
                    'phone' => $phone,
                    'address' => $address,
                    'email' => $email,
                    'boss' => $boss
                ]);
            }
        }

        return redirect()->route('admin.reestr_org_load')->with(['status' => true]);
    }

    public function org($id)
    {
        $org = ReestrOrg::where('num_cert', $id)->first();
        
        $curr_date = date("d.m.Y");
        $expire = false;		
        if(strtotime($curr_date) > strtotime($org->date_end)){
            $expire = true;
        }

        $program = json_decode($org->program);

        return view('pages.inner.org', ['org' => $org, 'program' => $program, 'expire' => $expire]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.reestr_org_create');
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
                "num_cert" => ["required"],
                "name_org" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $date_start = date("Y-m-d", strtotime($request->date_start));
        $date_end = date("Y-m-d", strtotime($request->date_end));

        // $program = NULL;

        // if(isset($request->program)){
        //     // foreach($request->program as $prog){
        //     //     $program .= '[' . $prog . '],';
        //     // }
        //     $program = json_encode($request->program);
        // }

        $program = json_encode($request->program);

        $reestr = ReestrOrg::create([
            "num_cert" => $request->num_cert,
            "name_org" => $request->name_org,
            "city" => $request->city,
            "region" => $request->region,
            "date_start" => $date_start,
            "date_end" => $date_end,
            "manager" => $request->manager,
            "website" => $request->website,
            "phone" => $request->phone,
            "address" => $request->address,
            "email" => $request->email,
            "boss" => $request->boss,
            "program" => $program
        ]);

        return redirect()->route('reestr_org.edit', $reestr->id)->with(['status' => true]);
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
        $reestr = ReestrOrg::find($id);

        return view('admin.pages.reestr_org_edit', ['reestr' => $reestr]);
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
                "num_cert" => ["required"],
                "name_org" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $reestr = ReestrOrg::find($id);

        $date_start = date("Y-m-d", strtotime($request->date_start));
        $date_end = date("Y-m-d", strtotime($request->date_end));

        $reestr->num_cert = $request->num_cert;
        $reestr->name_org = $request->name_org;
        $reestr->city = $request->city;
        $reestr->region = $request->region;
        $reestr->date_start = $date_start;
        $reestr->date_end = $date_end;
        $reestr->manager = $request->manager;
        $reestr->website = $request->website;
        $reestr->phone = $request->phone;
        $reestr->address = $request->address;
        $reestr->email = $request->email;
        $reestr->boss = $request->boss;
        $reestr->program = json_encode($request->program);

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
        $reestr = ReestrOrg::find($id);
        if($reestr) {
            $reestr->delete();
            return redirect()->route('admin.reestr_org')->with(["status" => true]);
        }else{
            return redirect()->route('admin.reestr_org')->with(["status" => false]);
        }
    }
}
