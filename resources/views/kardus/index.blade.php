@extends("layouts.global")

@section("title") Kardus @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="margin-bottom: -28px">
                <h4 class="card-title">Data KARDUS</h4>
            </div>
            <div class="card-body">

                <form class="d-flex justify-content-between" action="{{ route('kardus.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <button type="submit" class="btn btn-primary btn-rounded mb-3" title="Add Kardus"><i class="fa fa-plus color-primary"> CREATE KARDUS</i></button>
                </form>

                <div class="table-responsive">
                    <table class="display" id="kardus-table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Kardus</th>
                                <th>Tanggal</th>
                                <th>Jalur</th>
                                <th>Nama Petugas</th>
                                <th>Jumlah Batch</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                    </table>
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
                Are you sure to delete this Box ?
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
    var table = $('#kardus-table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('kardus.list') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'no_kardus',
                name: 'no_kardus'
            },
            {
                data: 'tanggal_kardus',
                name: 'tanggal_kardus'
            },
            {
                data: 'jalur',
                name: 'jalur'
            },
            {
                data: 'nama_petugas',
                name: 'nama_petugas'
            },
            {
                data: 'jumlah',
                name: 'jumlah'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    });
</script>

@endsection