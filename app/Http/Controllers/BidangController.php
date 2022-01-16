<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use DataTables;

class BidangController extends Controller
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
        return view('bidang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list()
    {
        $bidang = Bidang::all();
        return Datatables::of($bidang)
            ->addIndexColumn()
            ->addColumn('action', function($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="'.route('bidang.details', $opsi->id).'"><i class="fa fa-info-circle" title="Details"></i></a>';
                $action .= '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'. route('bidang.edit',$opsi->id) .'"><i class="fa fa-edit" title="Edit"></i></a>';
                $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'.route('bidang.delete',$opsi->id) .'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;})
            ->make();
    }
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
        $new_bidang = new \App\Models\Bidang;
        $new_bidang->nama_bidang = $request->get('nama_bidang');
        $new_bidang->save();
        return redirect()->route('bidang.index')->with('status', 'Nama Bidang successfully created.');
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
        $bidang = \App\Models\Bidang::findOrFail($id);
        return view('bidang.edit', compact('bidang'));
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
        $bidang = \App\Models\Bidang::findOrFail($id);
        $bidang->nama_bidang = $request->get('nama_bidang');
        $bidang->save();
        return redirect()->route('bidang.index')->with('status', 'Bidang successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bidang = Bidang::findorFail($id);
        $bidang->delete();
        return redirect()->route('bidang.index')->with('status', 'Bidang successfully deleted.');
    }
}
