<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seksi;
use App\Models\Bidang;
use DataTables;

class SeksiController extends Controller
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
        return view('seksi.index',compact('bidang'));
    }

    public function list()
    {
        $seksi = Seksi::with('bidang')->get();
        return Datatables::of($seksi)
            ->addIndexColumn()
            ->addColumn('action', function($opsi) {
                $action = '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'.route('seksi.details',$opsi->id).'"><i class="fa fa-info-circle" title="Details"></i></a>';
                $action .= '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="'.route('seksi.edit',$opsi->id).'"><i class="fa fa-pencil" title="Edit"></i></a>';
                $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'.route('seksi.delete',$opsi->id).'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
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
        $new_seksi = new \App\Models\Seksi;
        $new_seksi->nama_seksi = $request->get('nama_seksi');
        $new_seksi->bidang_id = $request->get('nama_bidang');
        $new_seksi->save();
        return redirect()->route('seksi.index')->with('status', 'Nama Seksi successfully created.');
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
        $bidang = Bidang::all();
        $seksi = \App\Models\Seksi::findOrFail($id);
        return view('seksi.edit', compact('seksi','bidang'));
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
        $seksi = \App\Models\Seksi::findOrFail($id);
        $seksi->nama_seksi = $request->get('nama_seksi');
        $seksi->bidang_id = $request->get('nama_bidang');
        $seksi->save();
        return redirect()->route('seksi.index')->with('status', 'Nama Seksi successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seksi = Seksi::findorFail($id);
        $seksi->delete();
        return redirect()->route('seksi.index')->with('status', 'Nama Seksi successfully deleted.');
    }
}
