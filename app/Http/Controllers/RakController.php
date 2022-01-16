<?php

namespace App\Http\Controllers;

use App\Models\DataGudang;
use App\Models\Rak;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $datagudang = DataGudang::all();
        return view('rak.index',compact('datagudang'));
    }

    public function create(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            "nama_rak" => "required|min:3|unique:rak",
        ]);

        if ($validator->fails()) {
            return redirect()->route('rak.index')->with('error', 'Data rak gagal ditambah')->withErrors($validator)->withInput();
        }

        $rak = new Rak();
        $rak->gudang_id =
        $rak->nama_rak = $request->get('nama_rak');
        $rak->gudang_id = $request->get('nama_gudang');
        $rak->save();
        return redirect()->route('rak.index')->with('status', 'Data gudang berhasil ditambahkan.');

    }

    public function list(){
        $rak = Rak::with('data_gudang')->get();
        return Datatables::of($rak)
            ->addIndexColumn()
            ->addColumn('action', function($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" href=""><i class="fa fa-info" title="Cetak"></i></a>';
                $action .= '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'.route('rak.edit',$opsi->id).'"><i class="fa fa-edit" title="Edit"></i></a>';
                // $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="/rak/delete/'.$opsi->id.'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;})
            ->make();
    }

    public function edit($id){
        $datagudang= DataGudang::all();
        $rak = \App\Models\Rak::findOrFail($id);
        return view('rak.edit', compact('rak','datagudang'));
    }

    public function update(Request $request, $id){

        $validator = \Validator::make($request->all(), [
            "nama_rak" => "required|min:3|unique:rak",
        ]);

        if ($validator->fails()) {
            return redirect()->route('rak.edit', [$id])->with('error', 'Data rak gagal diupdate')->withErrors($validator)->withInput();
        }

        $rak = Rak::findOrFail($id);
        $rak->nama_rak = $request->get('nama_rak');
        $rak->gudang_id = $request->get('nama_gudang');
        $rak->save();
        return redirect()->route('rak.index')->with('status', 'Data rak berhasil diupdate.');

    }

    public function delete($id){
        $rak = Rak::findOrFail($id);
        $rak->delete();
        return redirect()->route('rak.index')->with('status','Data rak berhasil dihapus');
    }

}
