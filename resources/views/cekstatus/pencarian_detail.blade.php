@extends("layouts.global")

<title>ARSIP - Search Dokumen</title>

@section("content")

<div class="row">
    <div class="col-xl-8 h-30">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">SEARCH DOKUMEN PIB</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
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
                    <form action="{{ route('cekstatus.search_detail') }}" method="POST">
                        @method('GET')
                        <div class="form-row align-items-center">
                            <div class="col-sm-5 my-1">
                                <label for="no_pib" class="sr-only">Nomor PIB</label>
                                <input type="text" id="no_pib" name="no_pib" class="form-control border border-light" placeholder="nomor PIB">
                            </div>

                            <div class="col-sm-5 my-1">
                                <label for="tgl_pib" class="sr-only">Tanggal</label>
                                <input type="text" name="tgl_pib" id="tgl_pib" class="form-control border border-light" placeholder="tanggal PIB">
                            </div>

                            <div class="col-sm-2 my-1">
                                <button type="submit" class="btn btn-primary">SEARCH</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('result'))
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">PIB {{ session('result')->no_pib }} tanggal {{ session('result')->tgl_pib }} a.n {{ session('result')->importir }}</h4>
                </div>
                <div class="card-body">
                    <h1></h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>BATCHING</td>
                                    <td>{{ session('result')->batching->no_batch }}</td>
                                    <td>{{ session('result')->batching->tanggal_batch }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section("js")

@endsection
