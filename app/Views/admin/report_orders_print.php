<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan |<?= config("App")->appName ?> <?= config("App")->companyName ?></title>

    <script src="<?= base_url('atlantis-lite') ?>/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['<?= base_url('atlantis - lite ') ?>/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('atlantis-lite') ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('atlantis-lite') ?>/css/atlantis.min.css">
    <style>
        body {
            margin: 25px;
        }

        .clearfix {
            zoom: 1;
        }

        .clearfix:before,
        .clearfix:after {
            content: "";
            display: table;
        }

        .clearfix:after {
            clear: both;
        }
    </style>
    <style type='text/css' media="print">
        @page {
            size: auto;
            margin: 0mm;
        }

        html {
            background-color: #FFFFFF;
            margin: 0px;
            font-size: 10px;
        }

        body {
            border: solid 1px #FFFFFF;
            margin: 5px 12px 0px 0px;
            font-size: 12px;
            font-family: 'Arial';
        }
    </style>

    <script type='text/javascript'>
        window.print();
    </script>
</head>

<body>
    <div style='text-align:center'>
        <b><?= config("App")->companyName ?></b>
        <br>
        Laporan Pejualan
        <br>
        <?= $title ?>
    </div>
    <hr>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class='text-center'>No</th>
                <th class='text-center'>Nama Penerima</th>
                <th class='text-center'>Produk</th>
                <th class='text-center'>Tgl.Pesanan</th>
                <th class='text-center'>Harga</th>
                <th class='text-center'>Kuantitas</th>
                <th class='text-center'>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $allTotal = 0; ?>
            <?php $no = 0; ?>
            <?php foreach ($rows as $row) : ?>
                <?php $no++; ?>
                <?php
                $thisTotal = $row->qty * $row->price;
                ?>
                <tr>
                    <td class='text-center'><?= $no ?></td>
                    <td><?= $row->name ?></td>
                    <td>
                        <?= $row->product_name ?>
                        <br>
                        <?= $row->variant_name ?>
                    </td>
                    <td class='text-right'><?= date("d-m-Y", strtotime($row->order_date)) ?></td>
                    <td class='text-right'>Rp. <?= number_format($row->price, 0, ",", ".") ?></td>
                    <td class='text-right'><?= $row->qty ?></td>
                    <td class='text-right'>Rp. <?= number_format($thisTotal, 0, ",", ".") ?></td>
                </tr>
                <?php $allTotal += $thisTotal; ?>
            <?php endforeach; ?>
            <tr>
                <th class='text-right' colspan='6'>TOTAL</th>
                <th class='text-right'>Rp. <?= number_format($allTotal, 0, ",", ".") ?></th>
            </tr>
        </tbody>
    </table>
    <br><br>
</body>

</html>