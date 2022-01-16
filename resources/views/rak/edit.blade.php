@extends("layouts.global")

@section("title") Edit Data RAK @endsection

@section("content")
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('rak.index') }}">Index</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Nama RAK</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <strong>Error!</strong> {{session('error')}}
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>
                </div>
                @endif
                <div class="basic-form">
                    <form action="{{ route('rak.update', $rak->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nama_gudang" class="col-sm-3 col-form-label">Nama Gudang</label>
                            <div class="col-sm-9">
                                <select id="nama_gudang" name="nama_gudang" class="form-control">
                                    @foreach($datagudang as $gdg)
                                    <option value="{{ $gdg->id}}" {{ $gdg->id ==  $rak->data_gudang->id ? 'selected' : '' }}>{{ $gdg->nama_gudang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_rak" class="col-sm-3 col-form-label">Nama RAK</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_rak" id="nama_rak" value="{{ $rak->nama_rak }}" class="form-control border border-light @error('nama_rak') is-invalid @enderror" required>
                                @error('nama_rak')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" value="save">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection