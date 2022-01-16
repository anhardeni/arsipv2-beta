<?php $__env->startSection("title"); ?> Dashboard <?php $__env->stopSection(); ?>
<!-- <script src="<?php echo e(asset('eatio/vendor/jquery/jquery.min.js')); ?>"></script> -->
<?php $__env->startSection('content'); ?>


<div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Dashboard</h2>
            <p class="mb-0">Hai <?php echo e(Auth::user()->name); ?>, selamat bekerja</p>
        </div>

        <div class="dropdown custom-dropdown">
            <div class="btn btn-sm btn-primary light d-flex align-items-center svg-btn" data-toggle="dropdown">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z" fill="#2F4CDD"></path>
                    </g>
                </svg>
                <div class="text-left ml-3">
                    <span class="d-block fs-16"><?php echo e(\Carbon\Carbon::now()->translatedFormat('l, d F Y')); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="widget-stat card">
                <div class="card-body p-4 border border-info rounded">
                    <div class="media ai-icon">
                        <span class="mr-1 bgl-primary text-primary">
                            <i class="fa fa-file"></i>
                        </span>
                        <div class="media-body">
                            <h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo e(App\Models\Pendok::count()); ?></span></h3>
                            <p class="mb-0">Jumlah PIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="widget-stat card">
                <div class="card-body p-4 border border-info rounded">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-primary text-primary">
                            <i class="fa fa-tasks"></i>
                        </span>
                        <div class="media-body">
                            <h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo e(App\Models\Batching::count()); ?></span></h3>
                            <p class="mb-0">Jumlah Batching</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="widget-stat card">
                <div class="card-body p-4 border border-info rounded">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-primary text-primary">
                            <i class="fa fa-cube"></i>
                        </span>
                        <div class="media-body">
                            <h3 class="mb-0 text-black"><span class="fs-32 font-w600 counter"><?php echo e(App\Models\Kardus::count()); ?></span></h3>
                            <p class="mb-0">Jumlah Kardus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection("js"); ?>
    <!-- <link href="<?php echo e(asset('eatio/css/style.css')); ?>" rel="stylesheet"> -->
    <script src="<?php echo e(asset('eatio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>"></script>

    <script src="<?php echo e(asset('eatio/vendor/waypoints/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('eatio/vendor/jquery.counterup/jquery.counterup.min.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('eatio/js/dashboard/dashboard-1.js')); ?>"></script> -->

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.global', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\arsip-bete\resources\views/home.blade.php ENDPATH**/ ?>