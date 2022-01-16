@extends("layouts.global")

@section("title") Batching Edit @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('batching.index')}}">Index</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Batch</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA BATCHING</h4>
            </div>

            <div class="card-body" style="margin-top: -25px">
                <div class="basic-form">
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label h3">No Batch</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border border-light bg-light" value="{{ $batching->no_batch }}" readonly>
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label h5">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control border border-light" value="{{ $batching->tanggal_batch }}" readonly>
                            </div>
                        </div>

                    </form>

                    <hr>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">BATCH PIB</h4>
            </div>
            <div class="card-body" style="margin-top: -25px">
                <div class="basic-form">
                    @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        {{session('status')}}
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        {{session('error')}}
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                    @endif

                    <form action="{{route('batching.add_dok', ['id'=>$batching->id])}}" method="POST">
                        
                    @csrf

                        <div class="form-group row">
                            <label for="no_pib" class="col-sm-4 col-form-label h6">No. PIB</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border border-light" id="no_pib" name="no_pib" placeholder="nomor PIB" required>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: -10px">
                            <label for="tgl_pib" class="col-sm-4 col-form-label h6" style="font-size: 0.99em">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border border-light" id="tgl_pib" name="tgl_pib" placeholder="dd-mm-yyyy" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm">B A T C H</button>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


<div class="table-responsive">
    <table class="display" id="pendok-table" style="min-width: 845px">
        <thead>
            <tr>
                <th>No</th>
                <th>No PIB</th>
                <th>Tanggal</th>
                <th>Importir</th>
                <th>Opsi</th>
            </tr>
        </thead>
    </table>
</div>

<div class="modal fade bd-example-modal-sm" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to delete this Data ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary light" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section("js")
<script src="{{ asset('eatio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('eatio/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('eatio/js/plugins-init/datatables.init.js') }}"></script>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<script>
    var table = $('#pendok-table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('batching.detail', ['id'=>$batching->id]) }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'no_pib',
                name: 'no_pib'
            },
            {
                data: 'tgl_pib',
                name: 'tgl_pib'
            },
            {
                data: 'importir',
                name: 'importir'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    });
</script>

@endsection