@extends("layouts.global")

@section("title") Edit User @endsection

@section("content")
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.index')}}">Index</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit User</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-body">

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

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="basic-form">
                    <form action="{{route('users.update', [$user->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="nama lengkap" value="{{$user->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nip">NIP</label>
                                <input type="text" name="nip" class="form-control" id="nip" placeholder="NIP" value="{{$user->nip}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pangkat">Pangkat</label>
                                <select id="pangkat" name="pangkat" class="form-control" value="{{ $user->pangkat }}">
                                    <option>--Pilih Pangkat--</option>
                                    @foreach($pangkat as $pkt)
                                    <option value="{{$pkt->nama_pangkat}}" {{ ($user->pangkat == $pkt->nama_pangkat) ? 'selected' : '' }}>{{$pkt->nama_pangkat}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bidang">Bidang</label>
                                <select id="bidang" name="bidang" class="form-control">
                                    <option>--Pilih Bidang--</option>
                                    @foreach($bidang as $bdg)
                                    <option value="{{$bdg->nama_bidang}}" {{ ($user->bidang == $bdg->nama_bidang) ? 'selected' : '' }}>{{$bdg->nama_bidang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="seksi">Seksi</label>
                                <select id="seksi" name="seksi" class="form-control">
                                    <label for="seksi">Seksi</label>
                                    <option>--Pilih Seksi--</option>
                                    @foreach($seksi as $sks)
                                    <option value="{{$sks->nama_seksi}}" {{ ($user->seksi == $sks->nama_seksi) ? 'selected' : '' }}>{{$sks->nama_seksi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jabatan">Jabatan</label>
                                <select id="jabatan" name="jabatan" class="form-control">
                                    <option>--Pilih Jabatan--</option>
                                    @foreach($jabatan as $jbt)
                                    <option value="{{$jbt->nama_jabatan}}" {{ ($user->jabatan == $jbt->nama_jabatan) ? 'selected' : '' }}>{{$jbt->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control bg-light" name="username" id="username" placeholder="username" value="{{$user->username}}" disabled readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="roles">Role User</label>
                                <select id="roles" name="roles" class="form-control" value="{{ $user->roles }}">
                                <option>--Pilih Role--</option>
                                @foreach($roles as $rls)
                                    <option value="{{$rls->nama_roles}}" {{ ($user->roles == $rls->nama_roles) ? 'selected' : '' }}>{{$rls->nama_roles}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input name="confirm_password" id="confirm_password" type="password" class="form-control" placeholder="confirm password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" value="save">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection