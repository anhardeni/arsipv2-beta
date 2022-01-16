<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Batching;
use App\Models\Pendok;
use DataTables;
use Illuminate\Support\Facades\DB;

class CekStatusController extends Controller
{
    public function index()
    {
        return view('cekstatus.index');
    }

    public function list()
    {
        // $pendok = DB::table('pendok')
        //     ->select(
        //         'pendok.id',
        //         'pendok.no_pib',
        //         'pendok.tgl_pib',
        //         'pendok.importir',
        //         'pendok.jalur'
        //     )->get();

        $pendok = Pendok::with('status');
        return DataTables::of($pendok)
            ->addIndexColumn()
            ->addColumn('action', function ($opsi) {
                $action = '<button class="btn btn-primary shadow btn-xs sharp mr-1 detail_status" data-href="'.route('cekstatus.detail', $opsi->id) . '" data-toggle="modal" data-target="#detail_status"><i class="fa fa-info" title="Detail"></i></button>';
                return $action;
            })
            ->addColumn('status', function ($status) {
                return $status->last_status ? $status->last_status->status : "";
            })
            ->make(true);
    }

    // $pendok = Pendok::orderBy('no_pib', 'desc')->get();

    // return Datatables::of($pendok)
    //     ->addIndexColumn()

    //     ->editColumn('jalur', function ($pendok) {
    //         $jalur = $pendok->jalur;

    //         $hijau = ['HH', 'HL', 'HM', 'RH'];
    //         $merah = ['MA', 'MH', 'MM'];
    //         $kuning = ['MK'];

    //         if (in_array($jalur, $hijau)) {
    //             return 'Hijau';
    //         } elseif (in_array($jalur, $merah)) {
    //             return 'Merah';
    //         } elseif (in_array($jalur, $kuning)) {
    //             return 'Kuning';
    //         }

    //         return $jalur;
    //     })

    //     ->addColumn('status', function ($status) {
    //         return $status->last_status ? $status->last_status->status : "";
    //     })

    //     ->addColumn('action', function ($opsi) {
    //         $action = '<button class="btn btn-primary shadow btn-xs sharp mr-1 detail_status" data-href="/cekstatus/detail/' . $opsi->id . '" data-toggle="modal" data-target="#detail_status"><i class="fa fa-info" title="Detail"></i></button>';
    //         return $action;
    //     })

    //     ->make(true);


    public function detail($id)
    {
        $pendok = Pendok::findOrFail($id);

        $status = ['BATCHING', 'KARDUS', 'GUDANG'];

        $batch = '';
        $kardus = '';
        $gudang = '';
        $peminjaman = '';

        $statusBatching = $pendok->status()->where('status', 'BATCHING')->latest()->first();
        if ($statusBatching) {
            $batch = $statusBatching->keterangan;
        }

        $statusKardus = $pendok->status()->where('status', 'DI KARDUS')->latest()->first();
        if ($statusKardus) {
            $kardus = $statusKardus->keterangan;
        }

        $statusGudang = $pendok->status()->where('status', 'DI GUDANG')->latest()->first();
        if ($statusGudang) {
            $gudang = $statusGudang->keterangan;
        }

        if ($pendok->peminjaman) {
            $statusPeminjaman = $pendok->status()->whereIn('status', ['PEREKAMAN ND MASUK', 'DIPINJAM', 'DIKEMBALIKAN'])->latest()->first();
            if ($statusPeminjaman) {
                $peminjaman = $statusPeminjaman->keterangan;
            }
        }

        return view('cekstatus.detail', compact('pendok', 'batch', 'kardus', 'gudang', 'peminjaman'));
    }

    public function pencarian_detail()
    {
        return view('cekstatus.pencarian_detail');
    }

    public function search_detail(Request $request)
    {
        $no_pib = $request->get('no_pib');
        $tgl_pib = $request->get('tgl_pib');

        $pendok = Pendok::with('batching')->where('no_pib', $no_pib)->where('tgl_pib', $tgl_pib)->first();

        // dd($pendok);

        if (!$pendok) {
            return redirect()->route('cekstatus.pencarian_detail')->with('error', 'Data PIB tidak ditemukan');
        } else {
            $request->session()->flash('result', $pendok);
            return redirect()->route('cekstatus.pencarian_detail')->with('status', 'Nomor PIB ' . $no_pib . ' tanggal ' . $tgl_pib . ' ditemukan');
        }
    }
}
