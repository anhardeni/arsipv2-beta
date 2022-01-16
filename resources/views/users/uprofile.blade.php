@extends("layouts.global")

@section("title") Update Profile @endsection

@section("content")
<div class="row justify-content-center h-100 align-items-center">
    <div class="col-xl-10 col-lg-12">
        <div class="card">
            <div class="card-header text-center">
                <h4>UPDATE PROFILE</h4>
            </div>
            <div class="card-body">

                @if(Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>Success!</strong> {{session('success')}}
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
                    <form action="{{route('users.uupdate', [$user->id])}}" method="POST">
                        @csrf
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
                                <select id="pangkat" name="pangkat" class="form-control">
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
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input name="confirm_password" id="confirm_password" type="password" class="form-control" placeholder="confirm password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" value="save">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection