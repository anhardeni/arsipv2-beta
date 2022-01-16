<?php $__env->startSection("title"); ?> Kardus Edit <?php $__env->stopSection(); ?>

<?php $__env->startSection("css"); ?>
<link href="<?php echo e(asset('eatio/vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('kardus.index')); ?>">Index</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Input Batch ke Kardus</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA KARDUS</h4>
                <a href="<?php echo e(route('kardus.jalur', ['id' => $kardus->id])); ?>"><i class="fa fa-edit" title="Edit"></i></a>
            </div>

            <div class="card-body" style="margin-top: -25px">
                <div class="basic-form">
                    <form action="<?php echo e(route('kardus.storejalur', ['id' =>$kardus->id])); ?>">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label h3">No Kardus</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border border-light bg-light" value="<?php echo e($kardus->no_kardus); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label h5">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control border border-light bg-light" value="<?php echo e($kardus->tanggal_kardus); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jalur" class="col-sm-3 col-form-label h5">Jalur</label>
                            <div class="col-sm-8">
                            <input type="text" name="jalur" id="jalur" class="form-control form-control border border-light" value="<?php echo e($kardus->jalur); ?>">
                            </div>
                            <!-- <button type="submit" class="btn btn-success h-50">SUBMIT</button> -->
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">INPUT BATCH</h4>
            </div>
            <div class="card-body" style="margin-top: -25px">
                <div class="basic-form">
                    
                    <?php if(session('status')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        <?php echo e(session('status')); ?>

                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        <?php echo e(session('error')); ?>

                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('kardus.add_batch', ['id'=>$kardus->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="no_batch" class="col-sm-4 col-form-label h6">No. BATCH</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border border-light" id="no_batch" name="no_batch" placeholder="nomor BATCH">
                            </div>
                        </div>

                        <div class="form-group row" style="margin-top: -10px">
                            <label for="tgl_pib" class="col-sm-4 col-form-label h6" style="font-size: 0.99em">Tahun</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border border-light" id="tahun" name="tahun" value="<?php echo e(\Carbon\Carbon::now()->year); ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">SUBMIT</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


<div class="table-responsive">
    <table class="display" id="kardus-table" style="min-width: 845px">
        <thead>
            <tr>
                <th>No</th>
                <th>No Batch</th>
                <th>Tanggal</th>
                <th>Jumlah Dokumen PIB</th>
                <th>Opsi</th>
            </tr>
        </thead>
    </table>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>
<script src="<?php echo e(asset('eatio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('eatio/vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('eatio/js/plugins-init/datatables.init.js')); ?>"></script>

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
        ajax: "<?php echo e(route('kardus.detail', ['id'=>$kardus->id])); ?>",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'no_batch',
                name: 'no_batch'
            },
            {
                data: 'tanggal_batch',
                name: 'tanggal_batch'
            },
            {
                data: 'jumlah_dokumen',
                name: 'jumlah_dokumen'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.global", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\arsip-bete\resources\views/kardus/edit.blade.php ENDPATH**/ ?>