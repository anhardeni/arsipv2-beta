<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pfpd;
use DataTables;

class PfpdController extends Controller
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
        return view('pfpd.index');
    }

    public function list()
    {
        $pfpd = Pfpd::all();
        return Datatables::of($pfpd)
            ->addIndexColumn()
            ->addColumn('action', function($opsi) {
                $action = '<a class="btn btn-success shadow btn-xs sharp mr-1" href="#"><i class="fa fa-info-circle" title="Details"></i></a>';
                $action .= '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="'.route('pfpd.edit',$opsi->id).'"><i class="fa fa-pencil" title="Edit"></i></a>';
                $action .= '<a class="btn btn-danger shadow btn-xs sharp mr-1" class="button delete-confirm" href="'.route('pfpd.delete',$opsi->id).'"><i class="fa fa-trash" title="Hapus"></i></a>';
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
        $new_pfpd = new \App\Models\Pfpd;
        $new_pfpd->pfpd = $request->get('pfpd');
        $new_pfpd->nip_pfpd = $request->get('nip_pfpd');
        $new_pfpd->save();
        return redirect()->route('pfpd.index')->with('status', 'PFPD User successfully created.');
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
        $pfpd = \App\Models\Pfpd::findOrFail($id);
        return view('pfpd.edit', compact('pfpd'));
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
        $pfpds = \App\Models\Pfpd::findOrFail($id);
        $pfpds->pfpd = $request->get('pfpd');
        $pfpds->nip_pfpd = $request->get('nip_pfpd');
        $pfpds->save();
        return redirect()->route('pfpd.index')->with('status', 'Pfpd successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pfpd = Pfpd::findorFail($id);
        $pfpd->delete();
        return redirect()->route('pfpd.index')->with('status', 'Pfpd successfully deleted.');
    }
}
