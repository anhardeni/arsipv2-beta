<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Pendok;
use App\Models\Batching;
use app\Models\Kardus;
use app\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getNama()
    {
        $nama = Batching::with(['user' => function (Builder $q) {
            $q->select('name');
        }])->groupBy('user_id')
            ->select('name')
            ->selectRaw('count(*) total_batch')
            ->get();
        return response()->json($nama);
    }

    public function getJumlah(){
        $jumlah =   DB::table('users')
                    ->select('users.id',DB::raw('count(batching.user_id) as jumlah'))
                    ->where('users.roles','Staff PDAD')
                    ->leftJoin('batching','users.id','=','batching.user_id')
                    ->groupBy('users.id')
                    ->get();
        return $jumlah;
    }

    // public function getJumlah()
    // {
    //     $counter = 0;
    //     $data = DB::table('batching')
    //         ->join('users', 'batching.user_id', '=', 'users.id')
    //         ->select('users.name')
    //         ->selectRaw('count(*) total_batch')
    //         ->groupBy('users.name')
    //         ->get();
    //     $y = $data->map(function ($e) use ($counter) {
    //         return [$counter++, $e->total_batch];
    //     });

    //     $x = $data->map(function ($e) use ($counter) {
    //         return [$counter++, $e->name];
    //     });

    //     return ['x' => $x, 'y' => $y];
    // }
}



    // Post::query()
    // ->with(array('user' => function($query) {
    //     $query->select('id','username');
    // }))
    // ->get();

    // public function getNama(){
    //     $nama = User::select('id','name')->where('roles','Staff PDAD')->get();
    //     return response()->json($nama);
    // }

    // public function getJumlah(){
    //     $jumlah =   DB::table('users')
    //                 ->select('users.id',DB::raw('count(batching.user_id) as jumlah'))
    //                 ->where('users.roles','Staff PDAD')
    //                 ->leftJoin('batching','users.id','=','batching.user_id')
    //                 ->groupBy('users.id')
    //                 ->get();
    //     return $jumlah;
    // }
