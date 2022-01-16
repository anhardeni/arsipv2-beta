<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendok;
use App\Models\Batching;
use App\Models\Status;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
use PHPUnit\Framework\Constraint\Count;

class BatchingController extends Controller
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

    public function index(Request $request)
    {

        if (!$request->session()->has('result')) {
            $request->session()->flash('result', new Pendok);
        }

        return view('batching.index');
    }

    public function list()
    {

        $batching = Batching::with('user')->orderBy('id', 'desc');

        return DataTables::of($batching)
            ->addIndexColumn()
            ->editColumn('tanggal_batch', function ($tanggal) {
                return $tanggal->tanggal_batch ? with(new Carbon($tanggal->tanggal_batch))->format('d-m-Y') : '';
            })
            ->addColumn('nama_petugas',function($opsi){
                return $opsi->nama_petugas;
            })
            ->addColumn('jumlah', function ($opsi) {
                return $opsi->pendok()->count();
            })

            ->addColumn('action', function ($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" target="blank" href="'. route('batching.print', $opsi->id) . '"><i class="fa fa-print" title="Cetak"></i></a>';
                $action .= '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'. route('batching.edit',  $opsi->id) . '"><i class="fa fa-edit" title="Edit"></i></a>';
                // $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'.route('batching.delete', $opsi->id) . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;
            })
            ->make(true);
    }

    public function create()
    {
        // $batching = Batching([
        //     $no = getSequence('batch', Carbon::now()->year),
        //     $year = Carbon::now()->year,
        //     $format = 'BATCH',
        //     'no_batch' => $format . '-' . $no . '/' . $year,
        //     'tanggal_batch' => Carbon::now(),
        //     'dokumen_id' => 0,
        // ]);

        $batching = new Batching;
        $no = getSequence('batch', Carbon::now()->year);
        $year = Carbon::now()->year;
        $format = 'BATCH';

        $batching->no_batch = $format . '-' . $no . '/' . $year;
        $batching->tanggal_batch = Carbon::now();

        $batching->user()->associate(Auth::user());
        $batching->save();

        return redirect()->route('batching.edit', ['id' => $batching->id]);
    }

    public function detail(Request $request, $id)
    {
        $batching = Batching::findOrFail($id)->pendok()->orderBy('updated_at', 'desc')->get();
        return Datatables::of($batching)
            ->addIndexColumn()
            ->addColumn('action', function ($opsi) {
                $action = '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'. route('batching.delete_dok', $opsi->id) . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></a>';
                return $action;
            })
            ->make(true);
    }

    public function print($id)
    {
        $batch = Batching::findOrFail($id);
        $batch_p = Batching::findOrFail($id)->pendok()->get();
        $no = 1;
        $pdf = PDF::loadview('batching.print', compact('batch', 'batch_p', 'no'));
        return $pdf->stream('batch.pdf');
    }

    public function add_dok(Request $request, $id)
    {
        $no_pib = $request->get('no_pib');
        $tgl_pib = $request->get('tgl_pib');

        $pendok = Pendok::where('no_pib', $no_pib)->where('tgl_pib', $tgl_pib)->first();
        if (!$pendok) {
            return redirect()->route('batching.edit', ['id' => $id])->with('error', 'PIB tidak ditemukan');
        } else {
            if ($pendok->batching) {
                return redirect()->route('batching.edit', ['id' => $id])->with('error', 'PIB sudah dibatching');
            }

            $batching = Batching::findOrFail($id);
            $batching->pendok()->save($pendok);
            $pendok->status()->save(Status::make([
                'status' => "BATCHING",
                'keterangan' => "Dokumen masuk batch {$batching->no_batch} tgl {$batching->tanggal_batch}"
            ]));
            return redirect()->route('batching.edit', ['id' => $id])->with('status', 'PIB ' . $no_pib . ' berhasil dibatch');
        }
    }

    public function edit(Request $request, $id)
    {
        $batching = \App\Models\Batching::findOrFail($id);
        $user = Auth::user();
        $error = $request->get('error');
        return view('batching.edit', compact('batching', 'user', 'error'));
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
        //
    }

    public function delete_dok(Request $request, $id)
    {
        $delete_batch = Pendok::findOrFail($id);
        $delete_batch->batching()->dissociate();
        $delete_batch->save();
        return redirect()->back()->with('status', 'Data berhasil di hapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function delete($id)
    // {
    //     $batching = Batching::findOrFail($id);
    //     $batching->delete();
    //     return redirect()->back();
    // }
}
