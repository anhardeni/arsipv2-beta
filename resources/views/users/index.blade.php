@extends("layouts.global")

@section("title") Manage Users @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Users</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between" style="margin-top: -30px">
                    <button type="button" class="btn btn-rounded btn-primary mb-2" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"> Add User</i></button>
                </div>

                @if(Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>Success! </strong>{{session('success')}}
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>
                </div>
                @endif

                @if(Session::get('error'))
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
                    <table class="display" id="users-table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>NIP</th>
                                <th>Roles</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="add_user">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="basic-form">
                        <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" value="{{old('name')}}" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="nama lengkap">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nip">NIP</label>
                                    <input type="text" value="{{old('nip')}}" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="NIP">
                                    @error('nip')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="pangkat">Pangkat</label>
                                    <select id="pangkat" name="pangkat" class="form-control @error('pangkat') is-invalid @enderror">
                                        <option>--Pilih Pangkat--</option>
                                        @foreach($pangkat as $pkt)
                                        <option value="{{$pkt->nama_pangkat}}">{{$pkt->nama_pangkat}}</option>
                                        @endforeach
                                        @error('pangkat')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bidang">Bidang</label>
                                    <select id="bidang" name="bidang" class="form-control @error('bidang') is-invalid @enderror">
                                        <option value="">--Pilih Bidang--</option>
                                        @foreach($bidang as $bdg)
                                        <option value="{{$bdg->nama_bidang}}">{{$bdg->nama_bidang}}</option>
                                        @endforeach
                                        @error('bidang')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="seksi">Seksi</label>
                                    <select id="seksi" name="seksi" class="form-control @error('seksi') is-invalid @enderror">
                                        <option value="">--Pilih Seksi--</option>
                                        @foreach($seksi as $sks)
                                        <option value="{{$sks->nama_seksi}}">{{$sks->nama_seksi}}</option>
                                        @endforeach
                                        @error('seksi')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jabatan">Jabatan</label>
                                    <select id="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                                        <option value="">--Pilih Jabatan--</option>
                                        @foreach($jabatan as $jbt)
                                        <option value="{{$jbt->nama_jabatan}}">{{$jbt->nama_jabatan}}</option>
                                        @endforeach
                                        @error('jabatan')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" value="{{old('username')}}" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="username">
                                    @error('username')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="roles">Role User</label>
                                    <select id="roles" name="roles" class="form-control @error('roles') is-invalid @enderror">
                                        <option value="">--Pilih Role--</option>
                                        @foreach($roles as $rls)
                                        <option value="{{$rls->nama_roles}}">{{$rls->nama_roles}}</option>
                                        @endforeach
                                        @error('roles')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
                                    @error('password')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input id="confirm_password" name="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="confirm password">
                                    @error('confirm_password')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" value="save">Submit</button>
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
                    Are you sure to delete this User ?
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
        var table = $('#users-table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'roles',
                    name: 'roles'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                }
            ],
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>



    @endsection