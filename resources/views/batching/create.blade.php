@extends("layouts.global")

@section("title") Batching Edit @endsection

@section("css")
<link href="{{ asset('eatio/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section("content")

<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA BATCHING</h4>
            </div>

            <div class="card-body" style="margin-top: -25px">
                <div class="basic-form">
                    <form action="{{ route('batching.store') }}" method="POST">
                    @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label h3">No Batch</label>
                            <div class="col-sm-8">
                                <input type="text" id="no_batch" name="no_batch" class="form-control border border-light bg-light" value="{{ 'BATCH-'.$no_batch }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label h5">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" name="tanggal_batch" id="tanggal_batch" class="form-control border border-light" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success h-50">SAVE</button>

                    </form>

                    <hr>
                </div>
            </div>
        </div>
    </div>


   
@endsection