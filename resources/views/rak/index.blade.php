@extends("layouts.global")

@section("title") Data Rak @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Rak</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between" style="margin-top: -30px; margin-bottom: 10px;">
                    <button type="button" class="btn btn-rounded btn-primary mb-2" data-toggle="modal" data-target="#add_rak"><i class="fa fa-plus"> Add Nomor Rak</i></button>
                </div>

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

                <div class="table-responsive">
                    <table class="display" id="rak-table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gudang</th>
                                <th>Nama Rak</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_rak">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add rak</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="{{ route('rak.create')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="nama_gudang" class="col-sm-3 col-form-label">Nama Gudang</label>
                            <div class="col-sm-9">
                                <select id="nama_gudang" name="nama_gudang" class="form-control">
                                    @foreach($datagudang as $gdg)
                                        <option value="{{$gdg->id}}">{{$gdg->nama_gudang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_rak" class="col-sm-3 col-form-label">Nama rak</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('nama_rak') }}" name="nama_rak" id="nama_rak" class="form-control border border-light @error('nama_rak') is-invalid @enderror" placeholder="Nama Rak" required>
                                @error('nama_rak')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" value="save">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                Are you sure to delete this Rak ?
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
    $.fn.dataTable.ext.errMode = 'none';
    var table = $('#rak-table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('rak.list') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'data_gudang.nama_gudang',
                name: 'data_gudang.nama_gudang'
            },
            {
                data: 'nama_rak',
                name: 'nama_rak'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    });
</script>

@endsection
