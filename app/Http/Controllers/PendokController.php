<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pfpd;
use App\Models\Pendok;
use App\Imports\PendokImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class PendokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pfpd = Pfpd::all();
        return view('pendok.index', compact('pfpd'));
    }

    public function list()
    {
        $pendok = DB::table('pendok')->orderBy('id', 'desc');

        return DataTables::of($pendok)
            ->addIndexColumn()
            ->addColumn('action', function ($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="' . route('pendok.edit', $opsi->id) . '"><i class="fa fa-edit" title="Edit"></i></a>';
                $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="' . route('pendok.destroy', $opsi->id) . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;
            })
            ->editColumn('jalur', function ($pendok) {
                $jalur = $pendok->jalur;

                $hijau = ['HH', 'HL', 'HM', 'RH'];
                $merah = ['MA', 'MH', 'MM'];
                $kuning = ['MK'];

                if (in_array($jalur, $hijau)) {
                    return 'Hijau';
                } elseif (in_array($jalur, $merah)) {
                    return 'Merah';
                } elseif (in_array($jalur, $kuning)) {
                    return 'Kuning';
                }

                return $jalur;
            })
            ->make(true);
    }


    public function import(Request $request)
    {
        try {
            //code...
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            $file = $request->file('file');

            $nama_file = rand() . $file->getClientOriginalName();

            $file->move('file_impor', $nama_file);

            Excel::import(new PendokImport, public_path('/file_impor/' . $nama_file));

            Session::flash('sukses', 'Data PIB berhasil diimpor');

            return redirect()->route('pendok.index');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error', $th->getMessage());
            return redirect()->route('pendok.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pendok.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no_pib = $request->get('no_pib');
        $tgl_pib = $request->get('tgl_pib');

        $validasi = Pendok::where('no_pib', $no_pib)->where('tgl_pib', $tgl_pib)->count();

        if ($validasi > 0) {
            return redirect()->route('pendok.index')->with('error', 'Data sudah ada sebelumnya');
        }

        $new_dok = new \App\Models\Pendok;
        $new_dok->no_pib = $request->get('no_pib');
        $new_dok->tgl_pib = $request->get('tgl_pib');
        $new_dok->importir = $request->get('importir');
        $new_dok->nip_pfpd = $request->get('nip_pfpd');
        $new_dok->pfpd = $request->get('pfpd');
        $new_dok->tgl_tt = $request->get('tgl_tt');
        $new_dok->jalur = $request->get('jalur');
        $new_dok->jenisdok = $request->get('jenisdok');
        $new_dok->nm_terima = \Auth::user()->name;
        $new_dok->created_by = \Auth::user()->id;
        $new_dok->save();
        return redirect()->route('pendok.index')->with('status', 'Data berhasil ditambah.');
    }

    public function getNip($pfpdId)
    {
        $pfpd = Pfpd::findOrFail($pfpdId);
        if ($pfpd) {
            $nip = $pfpdId->nip_pfpd;
            return response()->json($nip);
        }
        return response()->json([]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pendok = Pendok::findOrFail($id);
        return view('pendok.edit', compact('pendok'));
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

        $new_dok = Pendok::findOrFail($id);
        $new_dok->no_pib = $request->get('no_pib');
        $new_dok->tgl_pib = $request->get('tgl_pib');
        $new_dok->importir = $request->get('importir');
        $new_dok->nip_pfpd = $request->get('nip_pfpd');
        $new_dok->pfpd = $request->get('pfpd');
        $new_dok->tgl_tt = $request->get('tgl_tt');
        $new_dok->jalur = $request->get('jalur');
        $new_dok->jenisdok = $request->get('jenisdok');
        $new_dok->created_by = \Auth::user()->id;
        $new_dok->save();

        return redirect()->route('pendok.index')->with('status', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pendok = Pendok::findOrFail($id);
        $pendok->delete();
        return redirect()->route('pendok.index')->with('status', 'Data berhasil dihapus');
    }
}
