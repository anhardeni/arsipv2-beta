@extends("layouts.global")

@section("title") Edit Data @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pendok.index') }}">Index</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Data PIB</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA PIB</h4>
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

                    <form action="{{ route('pendok.update', [ 'id' => $pendok->id]) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="no_pib" class="col-sm-2 col-form-label">Nomor PIB</label>
                            <div class="col-sm-4">
                                <input name="no_pib" id="no_pib" type="text" class="form-control border border-light" value="{{ $pendok->no_pib }}">
                            </div>
                            <label for="tgl_pib" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-4">
                                <input name="tgl_pib" id="tgl_pib" type="text" value="{{ $pendok->tgl_pib }}" class="form-control border border-light">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="importir" class="col-sm-2 col-form-label">Importir</label>
                            <div class="col-sm-4">
                                <input name="importir" id="importir" value="{{ $pendok->importir }}" type="text" class="form-control border border-light">
                            </div>
                            <label for="jalur" class="col-sm-2 col-form-label">Jalur</label>
                            <div class="col-sm-4">
                                <input name="jalur" id="jalur" type="text" class="form-control border border-light" value="{{ $pendok->jalur }}">
                            </div>

                            <label for="jalur" class="col-sm-2 col-form-label">Jenis Dok</label>
                            <div class="col-sm-4">
                                <input name="jenisdok" id="jenisdok" type="text" class="form-control border border-light" value="{{ $pendok->jenisdok }}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="pfpd" class="col-sm-2 col-form-label">PFPD</label>
                            <div class="col-sm-4">
                                <input name="pfpd" id="pfpd" type="text" class="form-control border border-light" value="{{ $pendok->pfpd }}">
                            </div>
                            <label for="nip_pfpd" class="col-sm-2 col-form-label">NIP PFPD</label>
                            <div class="col-sm-4">
                                <input name="nip_pfpd" id="nip_pfpd" value="{{ $pendok->nip_pfpd }}" type="text" class="form-control border border-light">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nm_terima" class="col-sm-2 col-form-label">Petugas Penerima</label>
                            <div class="col-sm-4">
                                <input name="nm_terima" id="nm_terima" value="{{ $pendok->nm_terima }}" type="text" class="form-control border border-light">
                            </div>
                            <label for="tgl_tt" class="col-sm-2 col-form-label">Tanggal Tanda Terima</label>
                            <div class="col-sm-4">
                                <input name="tgl_tt" id="tgl_tt" value="{{ $pendok->tgl_tt }}" type="text" class="form-control border border-light">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
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
<script src="{{ asset('eatio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('eatio/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('eatio/js/plugins-init/datatables.init.js') }}"></script>
@endsection