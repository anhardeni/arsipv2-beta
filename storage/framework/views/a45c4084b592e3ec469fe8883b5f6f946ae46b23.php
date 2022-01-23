<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Batch</title>
    <style>
        * {
            font-family: sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 30px;
            font-size: 20px;
            margin-bottom: 5px;
        }

        h3 {
            margin-bottom: 20px;
            font-size: 17px;
        }

        .styled-table {
            border-collapse: collapse;
            font-size: 0.8em;
            width: 90%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            margin-right: auto;
            margin-left: auto;
        }

        .styled-table thead tr {
            background-color: grey;
            color: #ffffff;
        }

        .styled-table th,
        .styled-table td {
            padding: 11px 14px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

    </style>
</head>

<body>

    <header>
        <h1>BATCHING DOKUMEN </h1>
        <h3><?php echo e($batch->no_batch); ?> TANGGAL <?php echo e(\Carbon\Carbon::parse($batch->tanggal_batch)->format('d-m-Y')); ?></h3>
    </header>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Dok</th>
                <th>Nomor Dok</th>
                <th>Tanggal</th>
                <th>Nama Importir</th>
                <th>Jalur</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $batch_p; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $btc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($no++); ?></td>
                <td><?php echo e($btc->jenisdok); ?></td>
                <td><?php echo e($btc->no_pib); ?></td>
                <td><?php echo e($btc->tgl_pib); ?></td>
                <td><?php echo e($btc->importir); ?></td>
                <td><?php echo e($btc->jalur); ?>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    </table>
</body>

</html><?php /**PATH D:\laragon\www\arsipv2-beta\resources\views/batching/print.blade.php ENDPATH**/ ?>