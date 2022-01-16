@extends("layouts.global")

@section("title") Edit Data PFPD @endsection

@section("content")
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Index</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Nama PFPD</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('pfpd.update', $pfpd->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nama_pfpd" class="col-sm-3 col-form-label">Nama pfpd</label>
                            <div class="col-sm-9">
                                <input type="text" name="pfpd" id="pfpd" value="{{ $pfpd->pfpd }}" class="form-control border border-light" placeholder="Nama Bidang" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nip_pfpd" class="col-sm-3 col-form-label">NIP PFPD</label>
                            <div class="col-sm-9">
                                <input type="text" name="nip_pfpd" id="nip_pfpd" value="{{ $pfpd->nip_pfpd }}" class="form-control border border-light" placeholder="Nama Bidang" required>
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
