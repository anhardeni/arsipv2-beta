@extends("layouts.global")

@section("title") Peminjaman Arsip @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">PEMINJAMAN ARSIP</h4>
            </div>
            <div class="card-body">

                <div class="d-flex justify-content-between" style="margin-top: -30px">
                    <a href="{{ route('peminjaman.create')}}" class="btn btn-rounded btn-primary btn-sm mb-3"> <i class="fa fa-plus"> Peminjaman ARSIP</i></a>
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
                    <table class="display" id="peminjaman-table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor ND</th>
                                <th>Tanggal</th>
                                <th>Asal</th>
                                <th>PIB</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nd_keluar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ND Keluar</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="" method="POST" id="nd_keluar">
                        @csrf
                        <div class="form-group row">
                            <label for="nd_keluar" class="col-sm-3 col-form-label">ND Keluar</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('nd_keluar') }}" name="nd_keluar" id="nd_keluar" class="form-control border border-light @error('nd_keluar') is-invalid @enderror" placeholder="Nomor ND Keluar" required>
                                @error('nd_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_nd_keluar" class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{ old('tgl_nd_keluar') }}" name="tgl_nd_keluar" id="tgl_nd_keluar" class="form-control border border-light @error('tgl_nd_keluar') is-invalid @enderror" required>
                                @error('tgl_nd_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tujuan_nd_keluar" class="col-sm-3 col-form-label">Tujuan</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('tujuan_nd_keluar') }}" name="tujuan_nd_keluar" id="tujuan_nd_keluar" class="form-control border border-light @error('tujuan_nd_keluar') is-invalid @enderror" placeholder="Tujuan ND" required>
                                @error('tujuan_nd_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" value="save" class="btn btn-primary btn-keluar">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nd_kembali">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ND Kembali</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form id="nd_kembali" method="post" action="">
                        @csrf
                        <div class="form-group row">
                            <label for="nd_kembali" class="col-sm-3 col-form-label">ND Kembali</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('nd_kembali') }}" name="nd_kembali" id="nd_kembali" class="form-control border border-light @error('nomor_nd_kembali') is-invalid @enderror" placeholder="Nomor ND Kembali" required>
                                @error('nd_kembali')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_nd_kembali" class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{ old('tgl_nd_kembali') }}" name="tgl_nd_kembali" id="tgl_nd_kembali" class="form-control border border-light @error('tgl_nd_kembali') is-invalid @enderror" required>
                                @error('nd_kembali')
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

    $(document).on('click', '.nd_keluar', function(e) {
        var target = $(this).data('href');
        console.log('menuju target :', target);
        var form = $('form#nd_keluar').attr('action',target);
        console.log(form);
    });

    //debug agar form tetap di halaman yang sama (tidak mengeksekusi)
    // $('#nd_keluar').on('submit', function(e) {
    //     e.preventDefault();
    //     console.log('aaaaa');
    // });

    $(document).on('click','.nd_kembali',function(e){
        var target = $(this).data('href');
        $('form#nd_kembali').attr('action',target);
    })



    // $('#nd_kembali').on('show.bs.modal', function(e) {
    //     $(this).find('.btn-kembali').attr('href', $(e.relatedTarget).data('href'));
    // });
</script>

<script>
    $.fn.dataTable.ext.errMode = 'none';
    var table = $('#peminjaman-table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('peminjaman.list') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searcable : false,
                orderable : false
            },
            {
                data: 'nd_masuk',
                name: 'nd_masuk'
            },
            {
                data: 'tgl_nd_masuk',
                name: 'tgl_nd_masuk'
            },
            {
                data: 'asal_nd',
                name: 'asal_nd'
            },
            {
                data: 'no_pib',
                name: 'no_pib'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    });
</script>

@endsection
