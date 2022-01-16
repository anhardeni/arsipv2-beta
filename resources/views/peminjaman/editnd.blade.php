@extends("layouts.global")

@section("title") Edit Jalur @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">EDIT ND MASUK</h4>
            </div>

            <div class="card-body" style="margin-top: -25px">
                <div class="basic-form">
                    <form action="{{route('peminjaman.updatend',['id' => $peminjaman->id]) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="nd_masuk" class="col-sm-3 col-form-label h3">ND Masuk</label>
                            <div class="col-sm-8">
                                <input type="text" name="nd_masuk" value="{{ $peminjaman->nd_masuk }}" id="nd_masuk" class="form-control border border-light @error('nd_masuk') is-invalid @enderror" required>
                                @error('nd_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgl_nd_masuk" class="col-sm-3 col-form-label h5">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_nd_masuk" value="{{ $peminjaman->tgl_nd_masuk }}" id="tgl_nd_masuk" class="form-control border border-light @error('tanggal_nd_masuk') is-invalid @enderror" required>
                                @error('tgl_nd_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="asal_nd" class="col-sm-3 col-form-label h5">Asal ND</label>
                            <div class="col-sm-8">
                                <input type="text" name="asal_nd" value="{{ $peminjaman->tujuan_nd }}" id="asal_nd" class="form-control border border-light @error('asal_nd') is-invalid @enderror" required>
                                @error('asal_nd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tujuan_nd" class="col-sm-3 col-form-label h5">Tujuan ND</label>
                            <div class="col-sm-8">
                                <input type="text" name="tujuan_nd" value="{{ $peminjaman->tujuan_nd }}" id="tujuan_nd" class="form-control border border-light @error('tujuan_nd') is-invalid @enderror" required>
                                @error('tujuan_nd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="perihal" class="col-sm-3 col-form-label h5">Perihal</label>
                            <div class="col-sm-8">
                                <input type="text" name="perihal" value="{{ $peminjaman->perihal }}" id="perihal" class="form-control border border-light @error('perihal') is-invalid @enderror" required>
                                @error('perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success h-50">UPDATE</button>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-12">

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EDIT ND KELUAR</h4>
                </div>

                <div class="card-body" style="margin-top: -25px">
                    <div class="basic-form">

                        <div class="form-group row">
                            <label for="nd_keluar" class="col-sm-3 col-form-label h3">ND Keluar</label>
                            <div class="col-sm-8">
                                <input type="text" name="nd_keluar" id="nd_keluar" class="form-control border border-light" value="{{ $peminjaman->nd_keluar }}">
                            </div>
                        </div>

                        <div class="form-group row" style="margin-top: -15px">
                            <label for="tgl_nd_keluar" class="col-sm-3 col-form-label h5">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_nd_keluar" id="tgl_nd_keluar" class="form-control border border-light" value="{{ $peminjaman->tgl_nd_keluar }}">
                            </div>
                        </div>

                        <div class="form-group row" style="margin-top: -8px">
                            <label for="tujuan_nd_keluar" class="col-sm-3 col-form-label h5">Tujuan</label>
                            <div class="col-sm-8">
                                <input type="text" name="tujuan_nd_keluar" id="tujuan_nd_keluar" class="form-control border border-light" value="{{ $peminjaman->tujuan_nd_keluar }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EDIT ND KEMBALI</h4>
                </div>

                <div class="card-body" style="margin-top: -25px">
                    <div class="basic-form">

                        <div class="form-group row">
                            <label for="nd_kembali" class="col-sm-3 col-form-label h3">ND Kembali</label>
                            <div class="col-sm-8">
                                <input type="text" name="nd_kembali" id="nd_kembali" class="form-control border border-light" value="{{ $peminjaman->nd_kembali }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgl_nd_kembali" class="col-sm-3 col-form-label h5">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl_nd_kembali" id="tgl_nd_kembali" class="form-control border border-light" value="{{ $peminjaman->tgl_nd_kembali }}">
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@section("js")

@endsection