@extends("layouts.global")

@section("title") Import Data @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="col-lg-12">
    <div class="card">
        <div class="card-header" style="margin-bottom: -30px">
            <h4 class="card-title">Impor Data PIB Merah dan Kuning</h4>
        </div>
        <div class="card-body">

            @if ($errors->has('file'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
            @endif

            @if ($sukses = Session::get('sukses'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $sukses }}</strong>
            </div>
            @endif

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

            @isset($error)
            <div class="alert alert-danger alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <strong>Error!</strong> {{$error}}
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div>
            @endisset

            <button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#imporpib"><span class="btn-icon-left text-success"><i class="fa fa-upload color-success"></i>
                </span>Upload</button>

            <form onsubmit="return confirm('Are you sure move all data ?')" class="d-inline" action="{{ route('imporpib.move_merah') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="GET">
                <button type="submit" class="btn btn-rounded btn-info"><span class="btn-icon-left text-info"><i class="fa fa-truck color-info"></i>
                    </span>Move Data</button>
            </form>

            <form onsubmit="return confirm('Are you sure delete all data ?')" class="d-inline" action="{{ route('imporpib.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="_method">
                <button type="submit" class="btn btn-rounded btn-danger"><span class="btn-icon-left text-danger"><i class="fa fa-trash color-danger"></i>
                    </span>Delete All</button>
            </form>

            <div class="modal fade" id="imporpib" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route("imporpib.impor_excel_merah") }}" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            </div>
                            <div class="modal-body">

                                {{ csrf_field() }}

                                <label>Pilih file excel</label>
                                <div class="form-group">
                                    <input type="file" name="file" required="required">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn btn-danger btn-sm light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-sm">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="display" id="imporpib-table" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl Terima</th>
                            <th>No PIB</th>
                            <th>Tanggal</th>
                            <th>Importir</th>
                            <th>Jalur</th>
                            <th>PFPD</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <?php /*
            <div class="table-responsive mt-3">
                <table class="table table-striped table-responsive-sm">
                    <thead>
                        <tr>
                            <th style="width:80px;"><strong>#</strong></th>
                            <th><strong>Tgl Terima</strong></th>
                            <th><strong>No PIB</strong></th>
                            <th><strong>Tanggal</strong></th>
                            <th><strong>Importir</strong></th>
                            <th><strong>Jalur</strong></th>
                            <th><strong>PFPD</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($imporpib as $pib)
                        <tr>
                            <td><strong>{{$no++}}</strong></td>
                            <td>{{ $pib->tgl_tt }}</td>
                            <td>{{ $pib->no_pib }}</td>
                            <td>{{ \Carbon\Carbon::parse($pib->tgl_pib)->format('d-m-Y') }}</td>
                            <td>{{ $pib->importir }}</td>
                            <td>{{ $pib->jalur }}</td>
                            <td>{{ $pib->pfpd }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            */ ?>

        </div>
    </div>
</div>
@endsection

@section("js")
<script src="{{ asset('eatio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('eatio/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('eatio/js/plugins-init/datatables.init.js') }}"></script>

<script>
    $.fn.dataTable.ext.errMode = 'none';
    var table = $('#imporpib-table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('imporpib.list') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'tgl_tt',
                name: 'tgl_tt'
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
                data: 'pfpd',
                name: 'pfpd'
            },
        ],
    });
</script>

@endsection
