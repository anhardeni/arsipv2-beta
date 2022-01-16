@extends("layouts.global")

@section("title") Edit Jalur @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")
<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">EDIT JALUR</h4>
            </div>

            <div class="card-body" style="margin-top: -25px">
                <div class="basic-form">
                    <form action="{{route('kardus.storejalur',['id' => $kardus->id]) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label h3">No Kardus</label>
                            <div class="col-sm-8">
                                <input type="text" name="no_kardus" id="no_kardus" class="form-control border border-light bg-light" value="{{ $kardus->no_kardus }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label h5">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" name="tanggal_kardus" id="tanggal_kardus" class="form-control border border-light bg-light"  value="{{ $kardus->tanggal_kardus }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jalur" class="col-sm-3 col-form-label h5">Jalur</label>
                            <select id="jalur" name="jalur" class="form-control col-sm-8 border border-light" required>
                                <option>--Pilih Jalur--</option>
                                <option value="Hijau">Hijau</option>
                                <option value="Kuning">Kuning</option>
                                <option value="Merah">Merah</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success h-50">SAVE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section("js")

@endsection