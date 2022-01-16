<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kardus;
use App\Models\DataGudang;
use App\Models\Gudang;
use App\Models\Rak;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use PDOException;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\Facades\DataTables;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gudang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list()
    {
        $gudang = Gudang::all();
        return Datatables::of($gudang)
            ->addIndexColumn()
            ->addColumn('nama_gudang', function ($opsi) {
                return $opsi->gudang->nama_gudang;
            })
            ->addColumn('nama_rak', function ($opsi) {
                return $opsi->rak->nama_rak;
            })
            ->addColumn('nomor_kardus', function ($opsi) {
                return $opsi->kardus->no_kardus;
            })
            ->addColumn('jalur', function ($opsi) {
                return $opsi->kardus->jalur;
            })
            ->addColumn('action', function ($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="'.route('gudang.edit', $opsi->id). '"><i class="fa fa-edit" title="Edit"></i></a>';
                // $action .= '<a class="btn btn-danger shadow btn-xs sharp mr-1" class="button delete-confirm" href="'.route('gudang.delete', $opsi->id) . '"><i class="fa fa-trash" title="Hapus"></i></a>';
                return $action;
            })
            ->make();
    }

    public function search(Request $request)
    {
        $no_kardus = $request->get('no_kardus');
        $tahun = $request->get('tahun');

        $kardus = Kardus::where('no_kardus', $no_kardus)->whereRaw("YEAR(tanggal_kardus) = ?", [$tahun])->first();
        if($kardus != null){
            $request->session()->flash('result', $kardus);
            return redirect()->route('gudang.create')->with('status', 'Data kardus ditemukan');
        }else{
            return redirect()->route('gudang.create')->with('error', 'Data tidak ditemukan');
        }
        // dd($kardus);
        // $request->session()->flash('result', $kardus);

        // dd($hasil);
        // if ($hasil != 0) {
            // return redirect()->route('gudang.create')->with('status', 'Data kardus ditemukan');
        // } else {
        //     return redirect()->route('gudang.create')->with('error', 'Data kardus tidak ditemukan');
        // }
    }

    public function getRak($gudangId)
    {
        $gudang = DataGudang::findOrFail($gudangId);
        if ($gudang) {
            $rak = $gudang->rak;
            return response()->json($rak);
        }
        return response()->json([]);
    }

    public function create(Request $request)
    {
        if (!$request->session()->has('result')) {
            $request->session()->flash('result', new Kardus);
        }
        $gudang = DataGudang::all();
        return view('gudang.create', compact('gudang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if (Kardus::where('id', $request->get('kardus'))->whereHas('gudang')->count()) {
                throw new \Exception('kardus sudah ada di gudang');
            }

            $gudang = new Gudang();
            $gudang->kardus()->associate(Kardus::findOrFail($request->get('kardus')));
            $gudang->gudang()->associate(DataGudang::findOrFail($request->get('nama_gudang')));
            $gudang->rak()->associate(Rak::findOrFail($request->get('nama_rak')));
            $gudang->save();

            foreach ($gudang->kardus->batching as $btc) {
                foreach ($btc->pendok as $pdk) {
                    $pdk->status()->save(Status::make([
                        'status' => "DI GUDANG",
                        'keterangan' => "Dokumen masuk ke gudang {$gudang->gudang->nama_gudang} dengan nomor Rak {$gudang->rak->nama_rak}",
                    ]));
                }
            }
            DB::commit();
            return redirect()->route('gudang.index')->with('status', 'Data berhasil ditambahkan');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('gudang.create')->with('error', $th->getMessage());
        }
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
        $gudang = \App\Models\Gudang::findOrFail($id);
        $datagudang = DataGudang::all();
        $rak = $gudang->gudang->rak;
        return view('gudang.edit', compact('datagudang', 'gudang', 'rak'));
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
        // dd($request);
        $gudang = Gudang::findOrFail($id);

        $gudang->gudang()->associate(DataGudang::findOrFail($request->get('nama_gudang')));
        $gudang->rak()->associate(Rak::findOrFail($request->get('nama_rak')));
        // $gudang->keterangan = $request->get('keterangan');
        $gudang->save();
        return redirect()->route('gudang.index')->with('success', 'Posisi kardus berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $gudang = Gudang::findOrFail($id);
        $gudang->delete();
        return redirect()->back();
    }
}
