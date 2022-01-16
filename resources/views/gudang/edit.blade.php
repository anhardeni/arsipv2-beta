@extends("layouts.global")

@section("title") Edit Gudang @endsection

@section("content")

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('gudang.index')}}">Index</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Posisi Kardus</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA KARDUS</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        <strong>Success! </strong>{{session('status')}}
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                    @endif

                    <form action="{{ route('gudang.update', [ 'id' => $gudang->id]) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="nomor_kardus" class="col-sm-2 col-form-label">Nomor Kardus</label>
                            <div class="col-sm-4">
                                <input name="nomor_kardus" id="nomor_kardus" type="text" class="form-control border border-light bg-light" value="{{ $gudang->kardus->no_kardus }}" readonly>
                            </div>
                            <label for="tanggal_kardus" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-4">
                                <input name="tanggal_kardus" id="tanggal_kardus" type="text" value="{{ $gudang->kardus->tanggal_kardus }}" class="form-control border border-light bg-light" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlah_batch" class="col-sm-2 col-form-label">Jumlah Batch</label>
                            <div class="col-sm-4">
                                <input name="jumlah_batch" id="jumlah_batch" value="{{ $gudang->kardus->batching()->count() }}" type="text" class="form-control border border-light bg-light" readonly>
                            </div>
                            <label for="jalur" class="col-sm-2 col-form-label">Jalur</label>
                            <div class="col-sm-4">
                                <input name="jalur" id="jalur" type="text" class="form-control border border-light bg-light" value="{{ $gudang->kardus->jalur }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_gudang" class="col-sm-2 col-form-label">Gudang </label>
                            <select id="nama_gudang" name="nama_gudang" class="col-sm-4 form-control" value="{{ $gudang->gudang->id }}">
                                <option>--Pilih Gudang--</option>
                                @foreach($datagudang as $gdg)
                                <option value="{{$gdg->id}}" {{ $gdg->id ==  $gudang->gudang->id ? 'selected' : '' }}>{{$gdg->nama_gudang}}</option>
                                @endforeach
                            </select>
                            <label for="nama_rak" class="col-sm-2 col-form-label">Nomor Rak</label>
                            <select id="nama_rak" name="nama_rak" class="col-sm-4 form-control" value="{{ $gudang->rak->id }}">
                                <option selected="selected">--Pilih rak--</option>
                                @foreach($rak as $rk)
                                <option value="{{$rk->id}}" {{ $rk->id ==  $gudang->rak->id ? 'selected' : '' }}>{{$rk->nama_rak}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Catatan</label>
                            <div class="col-sm-6">
                                <textarea name="keterangan" id="keterangan" class="form-control border border-light" cols="40" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">PINDAH POSISI</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("js")
<script>
    function dataRak(data) {
        console.log('dataRak adalah', data);
        var html = '';

        // console.log(html);
        var namaRak = document.getElementById('nama_rak');
        var getRak = $('#nama_rak').val();
        for (var i = 0; i < data.length; ++i) {
            html += `<option value="${data[i].id}" dbg="${getRak}">${data[i].nama_rak}</option>`;
        }
        namaRak.innerHTML = html;
    };


    var base = "{{ url('/gudang') }}";
    let gudang = document.querySelector('#nama_gudang');
    gudang.addEventListener('change', (e) => {
        // console.log('gudang berubah', e);
        updateDataRak(e.target.value);
    })

    function updateDataRak(gudang_id) {
        var url = base + '/' + gudang_id + '/rak';
        console.log(url);
        $.ajax({
            dataType: "json",
            url: url,
            data: null,
            success: dataRak
        });
    }
</script>

@endsection