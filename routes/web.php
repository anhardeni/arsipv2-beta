<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendokController;
use App\Http\Controllers\ImporpibController;
use App\Http\Controllers\BatchingController;
use App\Http\Controllers\KardusController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PfpdController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\CekStatusController;
use App\Http\Controllers\SeksiController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\DataGudangController;
use App\Http\Controllers\JenisdokController;
use App\Http\Controllers\JabatanController;
/*
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/home');
    }
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/getnama', [App\Http\Controllers\HomeController::class, 'getNama'])->name('home.getnama');
Route::get('/home/getjumlah', [App\Http\Controllers\HomeController::class, 'getJumlah'])->name('home.getjumlah');

Route::get('/users/list', [UserController::class, 'list'])->name('users.list')->middleware('can:isAdmin');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('can:isAdmin');
Route::get('/users/uprofile/{id}', [UserController::class, 'uprofile'])->name('users.uprofile');
Route::post('/users/uupdate/{id}', [UserController::class, 'uupdate'])->name('users.uupdate');
Route::get('/users/profile/{id}', [UserController::class, 'profile'])->name('users.profile');
Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete')->middleware('can:isAdmin');
Route::resource("users", UserController::class)->middleware('can:isAdmin');

Route::get('/pendok', [PendokController::class, 'index'])->name('pendok.index')->middleware('can:AdminAndStaff');
Route::get('/pendok/list', [PendokController::class, 'list'])->name('pendok.list')->middleware('can:AdminAndStaff');
Route::post('/pendok/import', [PendokController::class, 'import'])->name('pendok.import')->middleware('can:AdminAndStaff');
Route::post('/pendok/store', [PendokController::class, 'store'])->name('pendok.store')->middleware('can:AdminAndStaff');
Route::get('/pendok/edit/{id}', [PendokController::class, 'edit'])->name('pendok.edit')->middleware('can:AdminAndStaff');
Route::post('/pendok/update/{id}', [PendokController::class, 'update'])->name('pendok.update')->middleware('can:AdminAndStaff');
Route::get('/pendok/destroy/{id}', [PendokController::class, 'destroy'])->name('pendok.destroy')->middleware('can:AdminAndStaff');
// Route::resource('pendok', PendokController::class)->middleware('can:AdminAndStaff');

Route::post('/imporpib/impor_excel_hijau', [ImporpibController::class, 'impor_excel_hijau'])->name('imporpib.impor_excel_hijau')->middleware('can:AdminAndStaff');
Route::post('/imporpib/impor_excel_merah', [ImporpibController::class, 'impor_excel_merah'])->name('imporpib.impor_excel_merah')->middleware('can:AdminAndStaff');
Route::post('/imporpib/impor_excel_bc25', [ImporpibController::class, 'impor_excel_bc25'])->name('imporpib.impor_excel_bc25')->middleware('can:AdminAndStaff');

Route::post('/imporpib/delete', [ImporpibController::class, 'delete'])->name('imporpib.delete')->middleware('can:AdminAndStaff');
Route::post('/imporpib/hapus', [ImporpibController::class, 'hapus'])->name('imporpib.hapus')->middleware('can:AdminAndStaff');
Route::post('/imporpib/delete_bc25', [ImporpibController::class, 'delete_bc25'])->name('imporpib.delete_bc25')->middleware('can:AdminAndStaff');


Route::get('/imporpib/move', [ImporpibController::class, 'move'])->name('imporpib.move')->middleware('can:AdminAndStaff');
Route::get('/imporpib/move_merah', [ImporpibController::class, 'move_merah'])->name('imporpib.move_merah')->middleware('can:AdminAndStaff');
Route::get('/imporpib/move_bc25', [ImporpibController::class, 'move_bc25'])->name('imporpib.move_bc25')->middleware('can:AdminAndStaff');


Route::get('/imporpib/hijau', [ImporpibController::class, 'hijau'])->name('imporpib.hijau')->middleware('can:AdminAndStaff');
Route::get('/imporpib/merah', [ImporpibController::class, 'merah'])->name('imporpib.merah')->middleware('can:AdminAndStaff');
Route::get('/imporpib/bc25', [ImporpibController::class, 'bc25'])->name('imporpib.bc25')->middleware('can:AdminAndStaff');


Route::get('/imporpib/list', [ImporpibController::class, 'list'])->name('imporpib.list')->middleware('can:AdminAndStaff');
Route::resource("imporpib", ImporpibController::class)->middleware('can:AdminAndStaff');

// Route::post("/batching/search", [BatchingController::class, 'search'])->name('batching.search');
Route::get('/batching/list', [BatchingController::class, 'list'])->name('batching.list');
// Route::post('/batching/create', [BatchingController::class, 'create'])->name('batching.create')->middleware('can:AdminAndStaff');
Route::get('/batching/edit/{id}', [BatchingController::class, 'edit'])->name('batching.edit')->middleware('can:AdminAndStaff');
Route::get('/batching/detail/{id}', [BatchingController::class, 'detail'])->name('batching.detail')->middleware('can:AdminAndStaff');
Route::post('/batching/create', [BatchingController::class, 'create'])->name('batching.create')->middleware('can:AdminAndStaff');
Route::get('/batching/delete_dok/{id}', [BatchingController::class, 'delete_dok'])->name('batching.delete_dok')->middleware('can:AdminAndStaff');
Route::get('/batching/delete/{id}', [BatchingController::class, 'delete'])->name('batching.delete')->middleware('can:AdminAndStaff');
Route::get('/batching', [BatchingController::class, 'index'])->name('batching.index');
Route::post('/batching/add_dok/{id}', [BatchingController::class, 'add_dok'])->name('batching.add_dok')->middleware('can:AdminAndStaff');
Route::get('/batching/print/{id}', [BatchingController::class, 'print'])->name('batching.print');

Route::get('/kardus', [KardusController::class, 'index'])->name('kardus.index')->middleware('can:AdminAndRT');
Route::post('/kardus/search', [KardusController::class, 'search'])->name('kardus.search')->middleware('can:AdminAndRT');
Route::get('/kardus/list', [KardusController::class, 'list'])->name('kardus.list')->middleware('can:AdminAndRT');
Route::post('/kardus/store', [KardusController::class, 'store'])->name('kardus.store')->middleware('can:AdminAndRT');
Route::get('/kardus/edit/{id}', [KardusController::class, 'edit'])->name('kardus.edit')->middleware('can:AdminAndRT');
Route::get('/kardus/jalur/{id}', [KardusController::class, 'jalur'])->name('kardus.jalur')->middleware('can:AdminAndRT');
Route::post('/kardus/storejalur/{id}', [KardusController::class, 'storejalur'])->name('kardus.storejalur')->middleware('can:AdminAndRT');
Route::get('/kardus/detail/{id}', [KardusController::class, 'detail'])->name('kardus.detail')->middleware('can:AdminAndRT');
Route::post('/kardus/create', [KardusController::class, 'create'])->name('kardus.create')->middleware('can:AdminAndRT');
Route::get('/kardus/delete_kardus/{id}', [KardusController::class, 'delete_kardus'])->name('kardus.delete_kardus')->middleware('can:AdminAndRT');
Route::get('/kardus/delete_batch/{id}', [KardusController::class, 'delete_batch'])->name('kardus.delete_batch')->middleware('can:AdminAndRT');
Route::post('/kardus/add_batch/{id}', [KardusController::class, 'add_batch'])->name('kardus.add_batch')->middleware('can:AdminAndRT');
Route::get('/kardus/print/{id}', [KardusController::class, 'print'])->name('kardus.print')->middleware('can:AdminAndRT');

Route::get('/gudang', [GudangController::class, 'index'])->name('gudang.index')->middleware('can:AdminAndRT');
Route::get('/gudang/search', [GudangController::class, 'search'])->name('gudang.search')->middleware('can:AdminAndRT');
Route::get('/gudang/create', [GudangController::class, 'create'])->name('gudang.create')->middleware('can:AdminAndRT');
Route::post('/gudang/store', [GudangController::class, 'store'])->name('gudang.store')->middleware('can:AdminAndRT');
Route::get('/gudang/list', [GudangController::class, 'list'])->name('gudang.list')->middleware('can:AdminAndRT');
Route::get('/gudang/edit/{id}', [GudangController::class, 'edit'])->name('gudang.edit')->middleware('can:AdminAndRT');
Route::post('/gudang/update/{id}', [GudangController::class, 'update'])->name('gudang.update')->middleware('can:AdminAndRT');
Route::get('/gudang/delete/{id}', [GudangController::class, 'delete'])->name('gudang.delete')->middleware('can:AdminAndRT');
Route::get('/gudang/{id}/rak',[GudangController::class,'getRak'])->middleware('can:AdminAndRT');

Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index')->middleware('can:AdminAndRT');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create')->middleware('can:AdminAndRT');
Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store')->middleware('can:AdminAndRT');
Route::get('/peminjaman/editnd/{id}', [PeminjamanController::class, 'editnd'])->name('peminjaman.editnd')->middleware('can:AdminAndRT');
Route::post('/peminjaman/updatend/{id}', [PeminjamanController::class, 'updatend'])->name('peminjaman.updatend')->middleware('can:AdminAndRT');
Route::post('/peminjaman/pinjam/{id}', [PeminjamanController::class, 'pinjam'])->name('peminjaman.pinjam')->middleware('can:AdminAndRT');
Route::get('/peminjaman/list', [PeminjamanController::class, 'list'])->name('peminjaman.list')->middleware('can:AdminAndRT');
Route::get('/peminjaman/detail/{id}', [PeminjamanController::class, 'detail'])->name('peminjaman.detail')->middleware('can:AdminAndRT');
Route::get('/peminjaman/edit/{id}', [PeminjamanController::class, 'edit'])->name('peminjaman.edit')->middleware('can:AdminAndRT');
Route::get('/peminjaman/update/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update')->middleware('can:AdminAndRT');
Route::get('/peminjaman/info/{id}', [PeminjamanController::class, 'info'])->name('peminjaman.info')->middleware('can:AdminAndRT');
Route::post('/peminjaman/kembali/{id}', [PeminjamanController::class, 'kembali'])->name('peminjaman.kembali')->middleware('can:AdminAndRT');
Route::post('/peminjaman/keluar/{id}', [PeminjamanController::class, 'keluar'])->name('peminjaman.keluar')->middleware('can:AdminAndRT');
Route::get('/peminjaman/delete_pib/{id}', [PeminjamanController::class, 'delete_pib'])->name('peminjaman.delete_pib')->middleware('can:AdminAndRT');

Route::get('/datagudang', [DataGudangController::class, 'index'])->name('datagudang.index')->middleware('can:AdminAndRT');
Route::post('/datagudang/create', [DataGudangController::class, 'create'])->name('datagudang.create')->middleware('can:AdminAndRT');
Route::get('/datagudang/list', [DataGudangController::class, 'list'])->name('datagudang.list')->middleware('can:AdminAndRT');
Route::get('/datagudang/edit/{id}', [DataGudangController::class, 'edit'])->name('datagudang.edit')->middleware('can:AdminAndRT');
Route::post('/datagudang/update/{id}', [DataGudangController::class, 'update'])->name('datagudang.update')->middleware('can:AdminAndRT');
Route::get('/datagudang/delete/{id}', [DataGudangController::class, 'delete'])->name('datagudang.delete')->middleware('can:AdminAndRT');

Route::get('/rak', [RakController::class, 'index'])->name('rak.index')->middleware('can:AdminAndRT');
Route::post('/rak/create', [RakController::class, 'create'])->name('rak.create')->middleware('can:AdminAndRT');
Route::get('/rak/list', [RakController::class, 'list'])->name('rak.list')->middleware('can:AdminAndRT');
Route::get('/rak/edit/{id}', [RakController::class, 'edit'])->name('rak.edit')->middleware('can:AdminAndRT');
Route::get('/rak/delete/{id}', [RakController::class, 'delete'])->name('rak.delete')->middleware('can:AdminAndRT');
Route::resource("rak", RakController::class)->middleware('can:AdminAndRT');

Route::get('/cekstatus', [CekStatusController::class,'index'])->name('cekstatus.index');
Route::get('/cekstatus/list', [CekStatusController::class,'list'])->name('cekstatus.list');
Route::get('/cekstatus/detail/{id}', [CekStatusController::class,'detail'])->name('cekstatus.detail');
Route::get('/cekstatus/pencarian_detail', [CekStatusController::class,'pencarian_detail'])->name('cekstatus.pencarian_detail');
Route::get('/cekstatus/search_detail', [CekStatusController::class,'search_detail'])->name('cekstatus.search_detail');
//support PFPD
Route::get('/pfpd/list', [PfpdController::class, 'list'])->name('pfpd.list')->middleware('can:AdminAndStaff');
Route::get('/pfpd/edit/{id}', [PfpdController::class, 'edit'])->middleware('can:AdminAndStaff');
Route::get('/pfpd/delete/{pfpd:id}', [PfpdController::class, 'destroy'])->name('pfpd.delete')->middleware('can:AdminAndStaff');
Route::resource("pfpd", PfpdController::class)->middleware('can:AdminAndStaff');

//support bidang
Route::get('/bidang/list', [BidangController::class, 'list'])->name('bidang.list')->middleware('can:isAdmin');
Route::get('/bidang/edit/{id}', [BidangController::class, 'edit'])->middleware('can:isAdmin');
Route::get('/bidang/delete/{bidang:id}', [BidangController::class, 'destroy'])->name('bidang.delete')->middleware('can:isAdmin');
Route::resource("bidang", BidangController::class)->middleware('can:isAdmin');

//support seksi
Route::get('/seksi/list', [SeksiController::class, 'list'])->name('seksi.list')->middleware('can:isAdmin');
Route::get('/seksi/edit/{id}', [SeksiController::class, 'edit'])->middleware('can:isAdmin');
Route::get('/seksi/delete/{seksi:id}', [SeksiController::class, 'destroy'])->name('seksi.delete')->middleware('can:isAdmin');
Route::resource("seksi", SeksiController::class)->middleware('can:isAdmin');

//support pangkat
Route::get('/pangkat/list', [PangkatController::class, 'list'])->name('pangkat.list')->middleware('can:isAdmin');
Route::get('/pangkat/edit/{id}', [PangkatController::class, 'edit'])->middleware('can:isAdmin');
Route::get('/pangkat/delete/{pangkat:id}', [PangkatController::class, 'destroy'])->name('pangkat.delete')->middleware('can:isAdmin');
Route::resource("pangkat", PangkatController::class)->middleware('can:isAdmin');

//support jabatan
Route::get('/jabatan/list', [JabatanController::class, 'list'])->name('jabatan.list')->middleware('can:isAdmin');
Route::get('/jabatan/edit/{id}', [JabatanController::class, 'edit'])->middleware('can:isAdmin');
Route::get('/jabatan/delete/{pangkat:id}', [JabatanController::class, 'destroy'])->name('jabatan.delete')->middleware('can:isAdmin');
Route::resource("jabatan", JabatanController::class)->middleware('can:isAdmin');

//support Jenisdok
Route::get('/jenisdok/list', [JenisdokController::class, 'list'])->name('jenisdok.list')->middleware('can:isAdmin');
Route::get('/jenisdok/edit/{id}', [JenisdokController::class, 'edit'])->middleware('can:isAdmin');
Route::get('/jenisdok/delete/{pangkat:id}', [JenisdokController::class, 'destroy'])->name('jenisdok.delete')->middleware('can:isAdmin');
Route::resource("jenisdok", JenisdokController::class)->middleware('can:isAdmin');