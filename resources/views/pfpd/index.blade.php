@extends("layouts.global")

@section("title") Set Data PFPD @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data PFPD</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between" style="margin-top: -30px; margin-bottom: 10px;">
                    <button type="button" class="btn btn-rounded btn-primary mb-2" data-toggle="modal" data-target="#add_pfpd"><i class="fa fa-plus"> Add PFPD</i></button>
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

                <div class="table-responsive">
                    <table class="display" id="pfpd-table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama PFPD</th>
                                <th>NIP PFPD</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_pfpd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add PFPD</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="{{route("pfpd.store")}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="pfpd" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="pfpd" id="pfpd" class="form-control border border-light" placeholder="Nama PFPD" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nip_pfpd" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" name="nip_pfpd" id="nip_pfpd" class="form-control border border-light" placeholder="NIP PFPD" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" value="save">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_pfpd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add PFPD</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="{{route("pfpd.store")}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="pfpd" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="pfpd" id="pfpd" class="form-control border border-light" placeholder="Nama PFPD" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nip_pfpd" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" name="nip_pfpd" id="nip_pfpd" class="form-control border border-light" placeholder="NIP PFPD" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" value="save">Save</button>
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
<script>
    var table = $('#pfpd-table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('pfpd.list') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'pfpd',
                name: 'pfpd'
            },
            {
                data: 'nip_pfpd',
                name: 'nip_pfpd'
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            }
        ],
    });

    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    });

</script>
@endsection