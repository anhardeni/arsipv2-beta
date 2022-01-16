<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendok;
use App\Models\Status;
use Illuminate\Support\Carbon;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function list()
    {
        $peminjaman = Peminjaman::with('pendok')->orderBy('id','desc');
        return Datatables::of($peminjaman)
            ->addIndexColumn()
            ->editColumn('tgl_nd_masuk', function ($tanggal) {
                return $tanggal->tgl_nd_masuk ? with(new Carbon($tanggal->tgl_nd_masuk))->format('d-m-Y') : '';
            })
            ->addColumn('no_pib', function ($opsi) {
                return $opsi->pendok()->count();
            })
            ->addColumn('action', function ($opsi) {
                $action = '<a class="btn btn-primary shadow btn-xs sharp mr-1" href="'.route('peminjaman.info', $opsi->id) . '"><i class="fa fa-info" title="Detail"></i></a>';
                $action .= '<a class="btn btn-success shadow btn-xs sharp mr-1" href="'.route('peminjaman.edit', $opsi->id) . '"><i class="fa fa-edit" title="Edit"></i></a>';
                $action .= '<button class="btn btn-info shadow btn-xs sharp mr-1 nd_keluar" data-href="'.route('peminjaman.keluar', $opsi->id) . '" data-toggle="modal" data-target="#nd_keluar"><i class="fa fa-share" title="ND Keluar"></i></button>';
                $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1 nd_kembali" data-href="'.route('peminjaman.kembali', $opsi->id) . '" data-toggle="modal" data-target="#nd_kembali"><i class="fa fa-handshake-o" title="ND Kembali"></i></button>';
                // $action .= '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'.route('peminjaman.delete', $opsi->id) . '" data-toggle="modal" title="Hapus" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></button>';
                return $action;
            })
            ->make();
    }

    public function create(Request $request)
    {

        return view('peminjaman.create');
    }

    public function search(Request $request)
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nd_masuk" => "required|min:3|max:100|unique:peminjaman",
            "tgl_nd_masuk" => "required",
            "asal_nd" => "required",
            "tujuan_nd" => "required",
            "perihal" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->route('peminjaman.create')->with('error', 'Data ND gagal disimpan')->withErrors($validator)->withInput();
        }

        $peminjaman = new Peminjaman([
            'nd_masuk' => $request->get('nd_masuk'),
            'tgl_nd_masuk' => $request->get('tgl_nd_masuk'),
            'asal_nd' => $request->get('asal_nd'),
            'tujuan_nd' => $request->get('tujuan_nd'),
            'perihal' => $request->get('perihal'),
        ]);

        $peminjaman->status = 'PEREKAMAN ND MASUK';
        $peminjaman->user()->associate(Auth::user());
        $peminjaman->save();

        return redirect()->route('peminjaman.edit', ['id' => $peminjaman->id]);
    }

    public function editnd($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('peminjaman.editnd', compact('peminjaman'));
    }

    public function updatend(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $validator = Validator::make($request->all(), [
            "nd_masuk" => "required|min:3|max:100|unique:peminjaman",
            "tgl_nd_masuk" => "required",
            "asal_nd" => "required",
            "tujuan_nd" => "required",
            "perihal" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->route('peminjaman.editnd', ['id' => $peminjaman->id])->with('error', 'Data ND gagal disimpan')->withErrors($validator)->withInput();
        }


        $peminjaman->nd_masuk = $request->get('nd_masuk');
        $peminjaman->tgl_nd_masuk = $request->get('tgl_nd_masuk');
        $peminjaman->asal_nd = $request->get('asal_nd');
        $peminjaman->tujuan_nd = $request->get('tujuan_nd');
        $peminjaman->perihal = $request->get('perihal');
        $peminjaman->nd_keluar = $request->get('nd_keluar');
        $peminjaman->tgl_nd_keluar = $request->get('tgl_nd_keluar');
        $peminjaman->tujuan_nd_keluar = $request->get('tujuan_nd_keluar');
        $peminjaman->nd_kembali = $request->get('nd_kembali');
        $peminjaman->tgl_nd_kembali = $request->get('tgl_nd_kembali');

        $peminjaman->user()->associate(Auth::user());

        $peminjaman->save();

        return redirect()->route('peminjaman.info', ['id' => $peminjaman->id]);
    }

    public function edit(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = Auth::user();
        return view('peminjaman.edit', compact('peminjaman', 'user'));
    }

    public function pinjam(Request $request, $id)
    {
        $no_pib = $request->get('no_pib');
        $tgl_pib = $request->get('tgl_pib');
        $jenisStatus = ['BATCHING','DI KARDUS','DI GUDANG','PEREKAMAN ND MASUK','DIPINJAM','DIKEMBALIKAN','TIDAK JADI DIPINJAM'];

        $pendok = Pendok::where('no_pib', $no_pib)->where('tgl_pib', $tgl_pib)->first();
        $filter = $pendok->status()->whereIn('status',$jenisStatus)->latest()->first()->status;
        $validasi = ['PEREKAMAN ND MASUK','DIPINJAM'];

        if (!$pendok) {
            return redirect()->route('peminjaman.edit', ['id' => $id])->with('error', 'Data PIB tidak ditemukan');
        } else {
            if (in_array($filter, $validasi)) {
                return redirect()->route('peminjaman.edit', ['id' => $id])->with('error', 'Data PIB masih dipinjam');
            }
            $peminjaman = Peminjaman::findOrFail($id);
            $peminjaman->pendok()->save($pendok);
            $pendok->status()->save(Status::make([
                'status' => "PEREKAMAN ND MASUK",
                'keterangan' => "Dokumen belum diserahkan ke {$peminjaman->asal_nd}"
            ]));
            return redirect()->route('peminjaman.edit', ['id' => $id])->with('status', 'PIB berhasil dipinjam');
        }
    }

    public function detail($id)
    {
        $peminjaman = Peminjaman::findOrFail($id)->pendok()->orderBy('updated_at', 'desc')->get();
        return Datatables::of($peminjaman)
            ->addIndexColumn()
            ->addColumn('action', function ($opsi) {
                $action = '<button class="btn btn-danger shadow btn-xs sharp mr-1" data-href="'.route('peminjaman.delete_pib', $opsi->id) . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" title="Hapus"></i></a>';
                return $action;
            })
            ->make(true);
    }

    public function info(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('peminjaman.info', compact('peminjaman'));
    }

    public function keluar(Request $request, $id)
    {
        $keluar = Peminjaman::findOrFail($id);
        $keluar->nd_keluar = $request->get('nd_keluar');
        $keluar->tgl_nd_keluar = $request->get('tgl_nd_keluar');
        $keluar->tujuan_nd_keluar = $request->get('tujuan_nd_keluar');
        $keluar->status = 'ND KELUAR';
        $keluar->save();

        $pendok = Pendok::where('peminjaman_id', $id)->get();
        foreach ($pendok as $pdk) {
            $pdk->status()->save(Status::make([
                'status' => "DIPINJAM",
                'keterangan' => "Dokumen masih dipinjam oleh {$keluar->asal_nd}"
            ]));
        }

        return redirect()->route('peminjaman.index')->with('status', 'ND Keluar berhasil disimpan');
    }

    public function kembali(Request $request, $id)
    {
        $kembali = Peminjaman::findOrFail($id);
        $kembali->nd_kembali = $request->get('nd_kembali');
        $kembali->tgl_nd_kembali = $request->get('tgl_nd_kembali');
        $kembali->status = 'DIKEMBALIKAN';
        $kembali->save();

        $pendok = Pendok::where('peminjaman_id', $id)->get();

        foreach ($pendok as $pdk) {
            $pdk->status()->save(Status::make([
                'status' => "DIKEMBALIKAN",
                'keterangan' => "Dokumen sudah dikembalikan oleh {$kembali->asal_nd} tanggal {$kembali->tgl_nd_kembali}"
            ]));
        }

        return redirect()->route('peminjaman.index')->with('status', 'ND Kembali berhasil disimpan');
    }

    public function delete_pib($id)
    {
        $delete_pib = Pendok::findOrFail($id);
        $delete_pib->peminjaman()->dissociate();
        $delete_pib->save();
        $delete_pib->status()->save(Status::make([
            'status' => "TIDAK JADI DIPINJAM",
            'keterangan' => "Dokumen tidak jadi dipinjam"
        ]));
        return redirect()->back()->with('status', 'PIB tidak jadi dipinjam');
    }
}
