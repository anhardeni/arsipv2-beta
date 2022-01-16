@extends("layouts.global")

@section("title") Penerimaan Dokumen @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="margin-bottom: -28px">
                <h4 class="card-title">CEK STATUS DOKUMEN</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="display" id="status-table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No PIB</th>
                                <th>Tanggal</th>
                                <th>Importir</th>
                                <th>Jalur</th>
                                <!-- <th>PFPD</th> -->
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="detail_status">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">DETAIL STATUS</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail_rincian_status">

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
    function dataStatus(data) {
        // console.log(data);
        $('#detail_rincian_status').html(data);
    }

    $(document).on('click', '.detail_status', function(e) {
        $('#detail_rincian_status').html('loading');
        var target = $(this).data('href');

        $.ajax({
            url: target,
            data: null,
            success: dataStatus,
        });
    })
</script>

<script>
    // $.fn.dataTable.ext.errMode = 'none';
    $(function() {
        var table = $('#status-table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('cekstatus.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
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
                    data: 'jalur',
                    name: 'jalur'
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
        });
    });
</script>

@endsection