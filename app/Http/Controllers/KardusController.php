<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batching;
use App\Models\Kardus;
use DataTables;
use App\Models\Status;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KardusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('kardus.index');
    }

    public function list()
    {
        $kardus = Kardus::orderBy('id', 'desc');
        return Datatables::of($kardus)
            ->addIndexColumn()
            ->editColumn('tanggal_kardus', function ($tanggal) {
                return $tanggal->tanggal_kardus ? with(new Carbon($tanggal->tanggal_kardus))->format('d-m-Y') : '';
            })
            ->addColumn('nama_petugas', function ($opsi) {
                return $opsi->nama_petugas;
            })
            ->addColumn('jumlah', function ($opsi) {
                return $opsi->batching()->count();
            })
            ->addColumn('action', function ($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" target=_blank href="'.route('kardus.print', $opsi->id) . '"><i class="fa fa-print" title="Cetak"></i></a>';
                $action .= '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'.route('kardus.edit', $opsi->id) . '"><i class="fa fa-edit" title="Edit"></i></a>';
                // $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'.route('kardus.delete_kardus, $opsi->id) . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;
            })
            ->make();
    }

    public function create()
    {
        // $kardus = new Kardus([
        //     $no = getSequence('kardus', Carbon::now()->year),
        //     $tahun = Carbon::now()->year,
        //     $format = 'KARDUS',
        //     'no_kardus' => $format . '-' . $no . '/' . $tahun,
        //     'tanggal_kardus' => Carbon::now(),
        //     'dokumen_id' => 0,
        //     'jalur' => '',
        // ]);

        $kardus = new Kardus;
        $no = getSequence('kardus', Carbon::now()->year);
        $tahun = Carbon::now()->year;
        $format = 'KARDUS';
        $kardus->no_kardus = $format . '-' . $no . '/' . $tahun;
        $kardus->tanggal_kardus = Carbon::now();
        // 'dokumen_id' => 0,
        $kardus->jalur = '';


        $kardus->user()->associate(Auth::user());
        $kardus->save();

        return redirect()->route('kardus.edit', ['id' => $kardus->id]);
    }

    public function jalur($id)
    {
        $kardus = Kardus::findOrFail($id);
        return view('kardus.jalur', compact('kardus'));
    }

    public function storejalur(Request $request, $id)
    {
        $kardus = Kardus::findOrFail($id);
        $kardus->jalur = $request->get('jalur');
        $kardus->save();
        return redirect()->route('kardus.edit', ['id' => $kardus->id]);
    }

    public function detail($id)
    {
        $kardus = Kardus::findOrFail($id)->batching()->orderBy('updated_at', 'desc')->get();
        return Datatables::of($kardus)
            ->addIndexColumn()
            ->addColumn('jumlah_dokumen', function ($opsi) {
                return $opsi->pendok()->count();
            })
            ->addColumn('action', function ($opsi) {
                $action = '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'.route('kardus.delete_batch', $opsi->id) . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;
            })
            ->make(true);
    }

    public function search(Request $request)
    {
        $no_batch = $request->get('no_batch');
        $tanggal_batch = $request->get('tanggal_batch');

        $batch = Batching::where('no_batch', $no_batch)->where('tanggal_batch', $tanggal_batch)->first();

        $request->session()->flash('result', $batch);
        return redirect()->route('kardus.index');
    }

    public function add_batch(Request $request, $id)
    {
        $no_batch = $request->get('no_batch');
        $tahun = $request->get('tahun');

        $batch = Batching::where('no_batch', $no_batch)->whereRaw(
            "YEAR(tanggal_batch) = ?",
            [$tahun]
        )->first();

        // dd($batch);

        if (!$batch) {
            return redirect()->route('kardus.edit', ['id' => $id])->with('error', 'Batch tidak ditemukan');
        } else {
            if ($batch->kardus) {
                return redirect()->route('kardus.edit', ['id' => $id])->with('error', 'Batch sudah dikardus');
            }

            $kardus = Kardus::findOrFail($id);

            $kardus->batching()->save($batch);

            foreach($batch->pendok as $pendok){
                $pendok->status()->save(Status::make([
                    'status' => "DI KARDUS",
                    'keterangan' => "Dokumen masuk kardus {$kardus->no_kardus} tgl {$kardus->tanggal_kardus}",
                ]));
            }

            return redirect()->route('kardus.edit', ['id' => $id])->with('status','Batch berhasil dimasukkan kardus');
        }
    }

    public function edit(Request $request, $id)
    {
        $kardus = \App\Models\Kardus::findOrFail($id);
        $user = Auth::user();
        $error = $request->get('error');
        return view('kardus.edit', compact('kardus', 'user', 'error'));
    }

    public function delete_kardus(Request $request, $id)
    {
        $delete_kardus = Kardus::findOrFail($id);
        $delete_kardus->unsetRelation('batching');
        $delete_kardus->delete();
        return redirect()->back();
    }

    public function print($id){
        $kardus= Kardus::findOrFail($id);
        $kardus_p = Kardus::findOrFail($id)->batching()->get();
        $no = 1;
        $pdf = PDF::loadview('kardus.print', compact('kardus','kardus_p','no'));
        return $pdf->stream('kardus.pdf');
    }

    public function delete_batch(Request $request, $id)
    {
        $delete_batch = Batching::findOrFail($id);
        $delete_batch->kardus()->dissociate();
        $delete_batch->save();
        return redirect()->back();
    }
}
