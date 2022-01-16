<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Imports\PibImport;
use App\Models\Pib;
use App\Models\Pendok;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PDOException;
use Yajra\DataTables\Facades\DataTables;

class ImporpibController extends Controller
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
    // public function index()
    // {
    //     return view('imporpib.index');
    // }

    public function hijau()
    {
        return view('imporpib.hijau');
    }

    public function merah()
    {
        return view('imporpib.merah');
    }

     public function bc25()
    {
        return view('imporpib.bc25');
    }

    public function impor_excel_hijau(Request $request)
    {
        try {
            //code...
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            $file = $request->file('file');

            $nama_file = rand() . $file->getClientOriginalName();

            $file->move('file_impor', $nama_file);

            Excel::import(new PibImport, public_path('/file_impor/' . $nama_file));

            Session::flash('sukses', 'Data PIB berhasil diimpor');

            return redirect()->route('imporpib.hijau');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error',$th->getMessage());
            return redirect()->route('imporpib.hijau');
        }
    }

    public function impor_excel_merah(Request $request)
    {
        try {
            //code...
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            $file = $request->file('file');

            $nama_file = rand() . $file->getClientOriginalName();

            $file->move('file_impor', $nama_file);

            Excel::import(new PibImport, public_path('/file_impor/' . $nama_file));

            Session::flash('sukses', 'Data PIB berhasil diimpor');

            return redirect()->route('imporpib.merah');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error',$th->getMessage());
            return redirect()->route('imporpib.merah');
        }
    }

    public function impor_excel_bc25(Request $request)
    {
        try {
            //code...
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            $file = $request->file('file');

            $nama_file = rand() . $file->getClientOriginalName();

            $file->move('file_impor', $nama_file);

            Excel::import(new PibImport, public_path('/file_impor/' . $nama_file));

            Session::flash('sukses', 'Data bc25 berhasil diimpor');

            return redirect()->route('imporpib.bc25');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error',$th->getMessage());
            return redirect()->route('imporpib.bc25');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function move()
    {
        try {
            DB::beginTransaction();
            $imporpib = Pib::query()->get();
            foreach ($imporpib as $pib) {
                $no_pib = $pib->no_pib;
                $tgl_pib = $pib->tgl_pib;
                $importir = $pib->importir;
                $nip_pfpd = $pib->nip_pfpd;
                $pfpd = $pib->pfpd;
                $tgl_tt = $pib->tgl_tt;
                $jalur = $pib->jalur;
                $nm_terima = $pib->nm_terima;

                $pib = Pendok::byNomorTanggal($no_pib, $tgl_pib)->count();
                if($pib > 0){
                    continue;
                }

                $pendok = new Pendok();
                $pendok->no_pib = $no_pib;
                $pendok->tgl_pib = $tgl_pib;
                $pendok->importir = $importir;
                $pendok->nip_pfpd = $nip_pfpd;
                $pendok->pfpd = $pfpd;
                $pendok->tgl_tt = $tgl_tt;
                $pendok->jalur = $jalur;
                $pendok->nm_terima = $nm_terima;
                $pendok->created_by = \Auth::user()->id;
                $pendok->save();
            }
            DB::table('imporpib')->delete();
            // Pib::where('1','1')->delete();
            // DB::table('imporpib')->truncate();
            DB::commit();
            return redirect()->route('imporpib.hijau')->with('status', 'Data berhasil dipindah');
        } catch (PDOException $th) {
            DB::rollBack();
            return redirect()->route('imporpib.hijau')->with('error', $th->getMessage());
        }
    }

    public function move_merah()
    {
        try {
            DB::beginTransaction();
            $imporpib = Pib::query()->get();
            foreach ($imporpib as $pib) {
                $no_pib = $pib->no_pib;
                $tgl_pib = $pib->tgl_pib;
                $importir = $pib->importir;
                $nip_pfpd = $pib->nip_pfpd;
                $pfpd = $pib->pfpd;
                $tgl_tt = $pib->tgl_tt;
                $jalur = $pib->jalur;
                $nm_terima = $pib->nm_terima;

                $pib = Pendok::byNomorTanggal($no_pib, $tgl_pib)->count();
                if($pib > 0){
                    continue;
                }

                $pendok = new Pendok();
                $pendok->no_pib = $no_pib;
                $pendok->tgl_pib = $tgl_pib;
                $pendok->importir = $importir;
                $pendok->nip_pfpd = $nip_pfpd;
                $pendok->pfpd = $pfpd;
                $pendok->tgl_tt = $tgl_tt;
                $pendok->jalur = $jalur;
                $pendok->nm_terima = $nm_terima;
                $pendok->created_by = \Auth::user()->id;
                $pendok->save();
            }
            DB::table('imporpib')->delete();
            // Pib::where('1','1')->delete();
            // DB::table('imporpib')->truncate();
            DB::commit();
            return redirect()->route('imporpib.merah')->with('status', 'Data berhasil dipindah');
        } catch (PDOException $th) {
            DB::rollBack();
            return redirect()->route('imporpib.merah')->with('error', $th->getMessage());
        }
    }

    public function move_bc25()
    {
        try {
            DB::beginTransaction();
            $imporpib = Pib::query()->get();
            foreach ($imporpib as $pib) {
                $no_pib = $pib->no_pib;
                $tgl_pib = $pib->tgl_pib;
                $importir = $pib->importir;
                $nip_pfpd = $pib->nip_pfpd;
                $pfpd = $pib->pfpd;
                $tgl_tt = $pib->tgl_tt;
                $jalur = $pib->jalur;
                $nm_terima = $pib->nm_terima;
                $jenisdok = $pib->jenisdok;

                $pib = Pendok::byNomorTanggal($no_pib, $tgl_pib)->count();
                if($pib > 0){
                    continue;
                }

                $pendok = new Pendok();
                $pendok->no_pib = $no_pib;
                $pendok->tgl_pib = $tgl_pib;
                $pendok->importir = $importir;
                $pendok->nip_pfpd = $nip_pfpd;
                $pendok->pfpd = $pfpd;
                $pendok->tgl_tt = $tgl_tt;
                $pendok->jalur = $jalur;
                $pendok->nm_terima = $nm_terima;
                $pendok->jenisdok = $jenisdok;
                $pendok->created_by = \Auth::user()->id;
                $pendok->save();
            }
            DB::table('imporpib')->delete();
            // Pib::where('1','1')->delete();
            // DB::table('imporpib')->truncate();
            DB::commit();
            return redirect()->route('imporpib.bc25')->with('status', 'Data BC 2.5 berhasil dipindah');
        } catch (PDOException $th) {
            DB::rollBack();
            return redirect()->route('imporpib.bc25')->with('error', $th->getMessage());
        }
    }

    public function list()
    {
        $imporpib = Pib::orderBy('id','asc');
        return Datatables::of($imporpib)
            ->addIndexColumn()
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
            ->make();
    }

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
        //
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
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus()
    {
        DB::table('imporpib')->truncate();
        return redirect()->route('imporpib.hijau')->with('status', 'All data successfully deleted');
    }

    public function delete()
    {
        DB::table('imporpib')->truncate();
        return redirect()->route('imporpib.merah')->with('status', 'All data successfully deleted');
    }

    public function delete_bc25()
    {
        DB::table('imporpib')->truncate();
        return redirect()->route('imporpib.bc25')->with('status', 'All data BC 2.5 successfully deleted');
    }
}
