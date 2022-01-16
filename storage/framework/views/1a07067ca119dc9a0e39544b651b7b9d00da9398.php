<?php $__env->startSection("title"); ?> Edit Data <?php $__env->stopSection(); ?>

<?php $__env->startSection("css"); ?>
<link href="<?php echo e(asset('eatio/vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('pendok.index')); ?>">Index</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Data PIB</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DATA PIB</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
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

                    <form action="<?php echo e(route('pendok.update', [ 'id' => $pendok->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label for="no_pib" class="col-sm-2 col-form-label">Nomor PIB</label>
                            <div class="col-sm-4">
                                <input name="no_pib" id="no_pib" type="text" class="form-control border border-light" value="<?php echo e($pendok->no_pib); ?>">
                            </div>
                            <label for="tgl_pib" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-4">
                                <input name="tgl_pib" id="tgl_pib" type="text" value="<?php echo e($pendok->tgl_pib); ?>" class="form-control border border-light">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="importir" class="col-sm-2 col-form-label">Importir</label>
                            <div class="col-sm-4">
                                <input name="importir" id="importir" value="<?php echo e($pendok->importir); ?>" type="text" class="form-control border border-light">
                            </div>
                            <label for="jalur" class="col-sm-2 col-form-label">Jalur</label>
                            <div class="col-sm-4">
                                <input name="jalur" id="jalur" type="text" class="form-control border border-light" value="<?php echo e($pendok->jalur); ?>">
                            </div>

                            <label for="jalur" class="col-sm-2 col-form-label">Jenis Dok</label>
                            <div class="col-sm-4">
                                <input name="jenisdok" id="jenisdok" type="text" class="form-control border border-light" value="<?php echo e($pendok->jenisdok); ?>">
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="pfpd" class="col-sm-2 col-form-label">PFPD</label>
                            <div class="col-sm-4">
                                <input name="pfpd" id="pfpd" type="text" class="form-control border border-light" value="<?php echo e($pendok->pfpd); ?>">
                            </div>
                            <label for="nip_pfpd" class="col-sm-2 col-form-label">NIP PFPD</label>
                            <div class="col-sm-4">
                                <input name="nip_pfpd" id="nip_pfpd" value="<?php echo e($pendok->nip_pfpd); ?>" type="text" class="form-control border border-light">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nm_terima" class="col-sm-2 col-form-label">Petugas Penerima</label>
                            <div class="col-sm-4">
                                <input name="nm_terima" id="nm_terima" value="<?php echo e($pendok->nm_terima); ?>" type="text" class="form-control border border-light">
                            </div>
                            <label for="tgl_tt" class="col-sm-2 col-form-label">Tanggal Tanda Terima</label>
                            <div class="col-sm-4">
                                <input name="tgl_tt" id="tgl_tt" value="<?php echo e($pendok->tgl_tt); ?>" type="text" class="form-control border border-light">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection("js"); ?>
<script src="<?php echo e(asset('eatio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('eatio/vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('eatio/js/plugins-init/datatables.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.global", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\arsip-bete\resources\views/pendok/edit.blade.php ENDPATH**/ ?>