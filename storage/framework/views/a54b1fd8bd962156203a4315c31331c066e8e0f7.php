<?php $__env->startSection("title"); ?> Batching <?php $__env->stopSection(); ?>

<?php $__env->startSection("css"); ?>
<link href="<?php echo e(asset('eatio/vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('eatio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="margin-bottom: -28px">
                <h4 class="card-title">Data BATCHING</h4>
            </div>
            <div class="card-body">

                <form class="d-flex justify-content-between" action="<?php echo e(route('batching.create' )); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" value="POST">
                    <button type="submit" class="btn btn-primary btn-rounded mb-3" title="Add Batch"><i class="fa fa-plus color-primary"> CREATE BATCH</i></button>
                </form>

                <div class="table-responsive">
                    <table class="display" id="batching-table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Batch</th>
                                <th>Tanggal</th>
                                <th>Nama Petugas</th>
                                <th>Jumlah PIB</th>
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
                Are you sure to delete this Batch ?
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
    var table = $('#batching-table').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(route('batching.list')); ?>",
        columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false
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
                data: 'nama_petugas',
                name: 'nama_petugas'
            },
            {
                data: 'jumlah',
                name: 'jumlah'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.global", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\arsip-bete\resources\views/batching/index.blade.php ENDPATH**/ ?>