<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use DataTables;

class JabatanController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jabatan.index');
    }

    public function list()
    {
        $jabatan = Jabatan::all();
        return Datatables::of($jabatan)
            ->addIndexColumn()
            ->addColumn('action', function($opsi) {
                $action = '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'.route('jabatan.details',$opsi->id).'"><i class="fa fa-info-circle" title="Details"></i></a>';
                $action .= '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="'.route('jabatan.edit',$opsi->id).'"><i class="fa fa-pencil" title="Edit"></i></a>';
                $action .= '<a class="btn btn-danger shadow btn-xs sharp mr-1" class="button delete-confirm" href="'.route('jabatan.delete',$opsi->id).'"><i class="fa fa-trash" title="Hapus"></i></a>';
                return $action;})
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_jabatan = new \App\Models\Jabatan;
        $new_jabatan->nama_jabatan = $request->get('nama_jabatan');
        $new_jabatan->save();
        return redirect()->route('jabatan.index')->with('status', 'Nama Jabatan successfully created.');
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
        $pangkat = \App\Models\Jabatan::findOrFail($id);
        return view('Jabatan.edit', compact('jabatan'));
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
        $jabatan = \App\Models\Jabatan::findOrFail($id);
        $jabatan->nama_jabatan = $request->get('nama_jabatan');
        $jabatan->save();
        return redirect()->route('jabatan.index')->with('status', 'Nama jabatan successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::findorFail($id);
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with('status', 'Nama jabatan successfully deleted.');
    }
}
