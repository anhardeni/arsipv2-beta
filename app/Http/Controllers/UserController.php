<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\Roles;
use App\Models\Seksi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bidang = Bidang::all();
        $jabatan = Jabatan::all();
        $pangkat = Pangkat::all();
        $roles = Roles::all();
        $seksi = Seksi::all();
        return view("users.index", compact('bidang', 'jabatan', 'pangkat', 'roles', 'seksi'));
    }

    public function list()
    {
        $user = DB::table('users');
        return Datatables::of($user)
            ->addIndexColumn()
            ->addColumn('action', function ($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="#"><i class="fa fa-info-circle" title="Details"></i></a>';
                $action .= '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'.route('users.edit', $opsi->id) . '"><i class="fa fa-edit" title="Edit"></i></a>';
                // $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="/users/delete/' . $opsi->id . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "username" => "required|min:3|max:20|unique:users",
            "nip" => "required|min:5|max:50|unique:users",
            "pangkat" => "required|min:5|max:100",
            "bidang" => "required|min:5|max:100",
            "seksi" => "required|min:5|max:100",
            "jabatan" => "required|min:5|max:100",
            "roles" => "required",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.index')->with('error', 'User gagal ditambah')->withErrors($validator)->withInput();
        }

        $new_user = new \App\Models\User;
        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->nip = $request->get('nip');
        $new_user->pangkat = $request->get('pangkat');
        $new_user->bidang = $request->get('bidang');
        $new_user->seksi = $request->get('seksi');
        $new_user->jabatan = $request->get('jabatan');
        $new_user->roles = $request->get('roles');
        $new_user->password = Hash::make($request->get('password'));
        $new_user->save();
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function uprofile($id){
        $user = \App\Models\User::findOrFail($id);
        $bidang = Bidang::all();
        $jabatan = Jabatan::all();
        $pangkat = Pangkat::all();
        $roles = Roles::all();
        $seksi = Seksi::all();

        // return view('users.edit', ['user' => $user], compact('bidang','jabatan','pangkat','roles','seksi'));
        return view('users.uprofile', compact('user', 'bidang', 'jabatan', 'pangkat', 'roles', 'seksi'));
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
        $user = \App\Models\User::findOrFail($id);
        $bidang = Bidang::all();
        $jabatan = Jabatan::all();
        $pangkat = Pangkat::all();
        $roles = Roles::all();
        $seksi = Seksi::all();

        // return view('users.edit', ['user' => $user], compact('bidang','jabatan','pangkat','roles','seksi'));
        return view('users.edit', compact('user', 'bidang', 'jabatan', 'pangkat', 'roles', 'seksi'));
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

        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "pangkat" => "required",
            "bidang" => "required",
            "seksi" => "required",
            "jabatan" => "required",
            "roles" => "required",
            "confirm_password" => "same:password"
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', [$id])->with('error', 'User gagal diupdate')->withErrors($validator)->withInput();
        }

        $user = \App\Models\User::findOrFail($id);
        $user->name = $request->get('name');
        $user->nip = $request->get('nip');
        $user->pangkat = $request->get('pangkat');
        $user->bidang = $request->get('bidang');
        $user->seksi = $request->get('seksi');
        $user->jabatan = $request->get('jabatan');
        $user->roles = $request->get('roles');

        if (trim($request->get('password')) != '') {
            $user->password = Hash::make(trim($request->get('password')));
         }

        $user->save();
        return redirect()->route('users.index')->with('success', 'User successfully updated.');
    }

    public function uupdate(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "pangkat" => "required",
            "bidang" => "required",
            "seksi" => "required",
            "jabatan" => "required",
            "confirm_password" => "same:password"
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.uprofile', [$id])->with('error', 'Gagal update')->withErrors($validator)->withInput();
        }

        $user = \App\Models\User::findOrFail($id);
        $user->name = $request->get('name');
        $user->nip = $request->get('nip');
        $user->pangkat = $request->get('pangkat');
        $user->bidang = $request->get('bidang');
        $user->seksi = $request->get('seksi');
        $user->jabatan = $request->get('jabatan');

        if (trim($request->get('password')) != '') {
            $user->password = Hash::make(trim($request->get('password')));
         }

        $user->save();
        return redirect()->route('users.uprofile', [$id])->with('success', 'Profil berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function delete($id)
    // {
    //     $user = \App\Models\User::findOrFail($id);
    //     $user->delete();
    //     return redirect()->route('users.index')->with('status', 'User successfully deleted');
    // }

    public function profile($id){
        $user = \App\Models\User::findOrFail($id);
        return view('users.profile', compact('user'));
    }
}
