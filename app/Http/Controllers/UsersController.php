<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    use RegistersUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();

        $users = DB::table('users')
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                ->select('users.id', 'users.name', 'users.email', 'roles.title')
                ->paginate(10);

        return view('admin.pages.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->sortByDesc('id');

        return view('admin.pages.users_create', ['roles' => $roles]);
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
                "name" => ['required', 'string', 'max:255'],
                "email" => ['required', 'string', 'email', 'max:255', 'unique:users'],
                "password" => ['required', 'string', 'min:8', 'confirmed']
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $user_role = UserRole::create([
            "user_id" => $user->id,
            "role_id" => $request->role
        ]);

        // return [
        //     "status" => true,
        //     "video" => $video
        // ];

        return redirect()->route('users.edit', $user->id)->with(['status' => true]);
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
    public function edit(User $user)
    {
        $users = DB::table('users')
                ->select('users.id', 'users.name', 'users.email', 'users.password', 'roles.id as roles_id')
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                ->where('users.id', $user->id)
                ->first();

        $roles = Role::all()->sortByDesc('id');

        return view('admin.pages.users_edit', ['users' => $users, 'roles' => $roles]);
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
        if($request->change_password){
            $validator = Validator::make(
                $request->all(),
                [
                    "name" => ['required', 'string', 'max:255'],
                    "email" => ['required', 'string', 'email', 'max:255'],
                    "password" => ['required', 'string', 'min:8', 'confirmed']
                ]
            );
        }else{
            $validator = Validator::make(
                $request->all(),
                [
                    "name" => ['required', 'string', 'max:255'],
                    "email" => ['required', 'string', 'email', 'max:255'],
                ]
            );
        }

        if ($validator->fails()) {
            return redirect()->back()->with(["status" => false, "errors" => $validator->messages()]);
        }

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->isDirty()){
            $user->save();
        }
        
        $user_role = UserRole::where('user_id', $id)->first();

        $user_role->role_id = $request->role;

        if($user_role->isDirty()){
            $user_role->save();
        }
        
        // $user_role->toQuery()->update([
        //     'role_id' => $request->role,
        // ]);

        // $user_role_update = DB::table('user_roles')
        //                 ->where('user_id', $id)
        //                 ->update(['role_id' => $request->role]);

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
        $user = User::find($id);
        if($user) {
            $user->delete();
            return redirect()->route('admin.users')->with(["status" => true]);
        }else{
            return redirect()->route('admin.users')->with(["status" => false]);
        }
    }
}
