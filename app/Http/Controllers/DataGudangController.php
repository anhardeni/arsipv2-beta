<?php

namespace App\Http\Controllers;

use App\Models\DataGudang;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DataGudangController extends Controller
{
    public function index(){
        return view('datagudang.index');
    }

    public function list(){
        $datagudang = DataGudang::all();
        return Datatables::of($datagudang)
            ->addIndexColumn()
            ->addColumn('action', function($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="#"><i class="fa fa-info" title="Cetak"></i></a>';
                $action .= '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'.route('datagudang.edit', $opsi->id).'"><i class="fa fa-edit" title="Edit"></i></a>';
                // $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'.route('datagudang.delete',$opsi->id.)'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;})
            ->make();
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            "nama_gudang" => "required|min:3|unique:data_gudang",
        ]);

        if ($validator->fails()) {
            return redirect()->route('datagudang.index')->with('error', 'Data gudang gagal ditambah')->withErrors($validator)->withInput();
        }

        $datagudang = new DataGudang();
        $datagudang->nama_gudang = $request->get('nama_gudang');
        $datagudang->save();
        return redirect()->route('datagudang.index')->with('status', 'Data gudang berhasil ditambahkan.');

    }

    public function edit($id){
        $datagudang = \App\Models\DataGudang::findOrFail($id);
        return view('datagudang.edit', compact('datagudang'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "nama_gudang" => "required|min:3|unique:data_gudang",
        ]);

        if ($validator->fails()) {
            return redirect()->route('datagudang.edit', [$id])->with('error', 'Data gudang gagal diedit')->withErrors($validator)->withInput();
        }

        $datagudang = DataGudang::findOrFail($id);
        $datagudang->nama_gudang = $request->get('nama_gudang');
        $datagudang->save();
        return redirect()->route('datagudang.index')->with('status', 'Data gudang berhasil diupdate.');

    }

    // public function delete($id){
    //     $datagudang = DataGudang::findorFail($id);
    //     // $datagudang->rak()->dissociate();
    //     $datagudang->delete();
    //     return redirect()->route('datagudang.index')->with('status', 'Nama gudang berhasil dihapus.');

    // }
}
