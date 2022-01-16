<?php $__env->startSection("title"); ?> Penerimaan Dokumen <?php $__env->stopSection(); ?>

<?php $__env->startSection("css"); ?>
<link href="<?php echo e(asset('eatio/vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="margin-bottom: -28px">
                <h4 class="card-title">DATA PENERIMAAN ARSIP</h4>
            </div>
            <div class="card-body">

                <button type="button" class="btn btn-rounded btn-primary mb-3" data-toggle="modal" data-target="#add_pendok"><i class="fa fa-plus"> Add Data Arsip</i></button>
                

                <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="post" action="<?php echo e(route('pendok.import')); ?>" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                </div>
                                <div class="modal-body">

                                    <?php echo e(csrf_field()); ?>


                                    <label>Pilih file excel</label>
                                    <div class="form-group">
                                        <input type="file" name="file" required="required">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="add_pendok">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Data Arsip</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">

                                    <form action="<?php echo e(route('pendok.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group row">
                                            <label for="no_pib" class="col-sm-4 col-form-label h6">No. PIB</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="no_pib" name="no_pib" placeholder="nomor PIB">
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top: -10px">
                                            <label for="tgl_pib" class="col-sm-4 col-form-label h6" style="font-size: 0.99em">Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control " id="tgl_pib" name="tgl_pib" placeholder="dd-mm-yyyy">
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top: -10px">
                                            <label for="importir" class="col-sm-4 col-form-label h6">Importir</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="importir" name="importir" placeholder="nama importir">
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top: -10px">
                                            <label for="pfpd" class="col-sm-4 col-form-label h6">PFPD</label>
                                            <div class="col-sm-8">
                                                <select id="pfpd" name="pfpd" class="form-control">
                                                    <?php $__currentLoopData = $pfpd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($pfp->pfpd); ?>"><?php echo e($pfp->pfpd); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="text" name="nip_pfpd" id="nip_pfpd" value="<?php echo e($pfp->nip_pfpd); ?>" hidden>

                                        <div class="form-group row" style="margin-top: -10px">
                                            <label for="jalur" class="col-sm-4 col-form-label h6">Jalur</label>
                                            <div class="col-sm-8">
                                                <select id="jalur" name="jalur" class="form-control">
                                                    <option value="Hijau">Hijau</option>
                                                    <option value="Kuning">Kuning</option>
                                                    <option value="Merah">Merah</option>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="form-group row" style="margin-top: -10px">
                                            <label for="jenis dok" class="col-sm-4 col-form-label h6">Jenis Dok</label>
                                            <div class="col-sm-8">
                                                <select id="jenisdok" name="jenisdok" class="form-control">
                                                    <option value="4">BC 2.5</option>
                                                    <option value="5">Surat Kuasa</option>
                                                    <option value="1">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>

                                        <input class="form-control" id="tgl_tt" name="tgl_tt" value="<?php echo e(\Carbon\Carbon::now()->format('d-m-Y H:i:s')); ?>" hidden>

                                        <button type="submit" class="btn btn-primary" value="save">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(session('status')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>Success! </strong><?php echo e(session('status')); ?>

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
                    <strong>Error!</strong> <?php echo e(session('error')); ?>

                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>
                </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="display" id="pendok-table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Terima</th>
                                <th>No PIB</th>
                                <th>Tanggal</th>
                                <th>Importir</th>
                                <th>Jalur</th>
                                <th>PFPD</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                    </table>
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
    // $.fn.dataTable.ext.errMode = 'none';
    var table = $('#pendok-table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(route('pendok.list')); ?>",
        columns: [{
                data: 'DT_RowIndex',
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
            {
                data: 'action',
                name: 'action'
            },
        ],
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.global", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\arsip-bete\resources\views/pendok/index.blade.php ENDPATH**/ ?>