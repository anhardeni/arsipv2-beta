<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenisdok;
use Illuminate\Support\Facades\Validator;
use DataTables;

class JenisdokController extends Controller
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
        return view('jenisdok.index');
    }

    public function list()
    {
        $jenisdok = Jenisdok::all();
        return Datatables::of($jenisdok)
            ->addIndexColumn()
            ->addColumn('action', function($opsi) {
                $action = '<a class="btn btn-success shadow btn-xs sharp mr-1" href="#"><i class="fa fa-info-circle" title="Details"></i></a>';
                $action .= '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="'.route('jenisdok.edit',$opsi->id).'"><i class="fa fa-pencil" title="Edit"></i></a>';
                $action .= '<a class="btn btn-danger shadow btn-xs sharp mr-1" class="button delete-confirm" href="'.route('jenisdok.delete',$opsi->id).'"><i class="fa fa-trash" title="Hapus"></i></a>';
                return $action;})
            ->make();
    }

      public function create(Request $request){

        $validator = Validator::make($request->all(), [
            "nama_dokumen" => "required|min:3|unique:jenis_dok",
        ]);

        if ($validator->fails()) {
            return redirect()->route('jenisdok.index')->with('error', 'Data gagal ditambah')->withErrors($validator)->withInput();
        }

        $jenisdok = new Jenisdok();
        $jenisdok->nama_dokumen = $request->get('nama_dokumen');
        $jenisdok->save();
        return redirect()->route('jenisdok.index')->with('status', 'Data berhasil ditambahkan.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  public function create(Request $request){

    //     $validator = Validator::make($request->all(), [
    //         "nama_gudang" => "required|min:3|unique:data_gudang",
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('datagudang.index')->with('error', 'Data gudang gagal ditambah')->withErrors($validator)->withInput();
    //     }

    //     $datagudang = new DataGudang();
    //     $datagudang->nama_gudang = $request->get('nama_gudang');
    //     $datagudang->save();
    //     return redirect()->route('datagudang.index')->with('status', 'Data gudang berhasil ditambahkan.');

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_jenisdok = new \App\Models\Jenisdok;
        $new_jenisdok->nama_dokumen = $request->get('nama_dokumen');
        $new_jenisdok->save();
        return redirect()->route('jenisdok.index')->with('status', 'Nama jenisdok successfully created.');
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
        $pangkat = \App\Models\Jenisdok::findOrFail($id);
        return view('Jenisdok.edit', compact('jenisdok'));
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
        $jenisdok = \App\Models\Jenisdok::findOrFail($id);
        $jenisdok->nama_dokumen = $request->get('nama_dokumen');
        $jenisdok->save();
        return redirect()->route('jenisdok.index')->with('status', 'Nama jenisdok successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenisdok = Jenisdok::findorFail($id);
        $jenisdok->delete();
        return redirect()->route('jenisdok.index')->with('status', 'Nama Dokumen successfully deleted.');
    }
}

