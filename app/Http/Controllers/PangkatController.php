<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pangkat;
use DataTables;

class PangkatController extends Controller
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
        return view('pangkat.index');
    }

    public function list()
    {
        $pangkat = Pangkat::all();
        return Datatables::of($pangkat)
            ->addIndexColumn()
            ->addColumn('action', function($opsi) {
                $action = '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'.route('pangkat.details',$opsi->id).'"><i class="fa fa-info-circle" title="Details"></i></a>';
                $action .= '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="'.route('pangkat.edit',$opsi->id).'"><i class="fa fa-pencil" title="Edit"></i></a>';
                $action .= '<a class="btn btn-danger shadow btn-xs sharp mr-1" class="button delete-confirm" href="'.route('pangkat.delete',$opsi->id).'"><i class="fa fa-trash" title="Hapus"></i></a>';
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
        $new_pangkat = new \App\Models\Pangkat;
        $new_pangkat->nama_pangkat = $request->get('nama_pangkat');
        $new_pangkat->save();
        return redirect()->route('pangkat.index')->with('status', 'Nama pangkat successfully created.');
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
        $pangkat = \App\Models\Pangkat::findOrFail($id);
        return view('pangkat.edit', compact('pangkat'));
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
        $pangkat = \App\Models\Pangkat::findOrFail($id);
        $pangkat->nama_pangkat = $request->get('nama_pangkat');
        $pangkat->save();
        return redirect()->route('pangkat.index')->with('status', 'Nama pangkat successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pangkat = Pangkat::findorFail($id);
        $pangkat->delete();
        return redirect()->route('pangkat.index')->with('status', 'Nama pangkat successfully deleted.');
    }
}
